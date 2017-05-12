<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\DotLangParser as _DotLangParser;

require_once __DIR__ . '/../bootstrap.php';

class DotLangParser extends atoum\test
{
    public function getFileDP()
    {
        $test_file = TEST_FILES . 'dotlang/toto.lang';

        return [
            [
                $test_file,
                [
                    '## active ##',
                    '## I am a tag ##',
                    '## NOTE: I am metadata',
                    '## URL: https://www-dev.allizom.org/about/history',
                    '# I am a comment',
                    ';Browser',
                    'Navigateur',
                    ';Mail',
                    'Courrier',
                    '2nd line',
                    '3rd line',
                    '# another comment',
                    ';Hello',
                    'Bonjour',
                    ';Hello',
                    'Bonjour',
                    ';Empty string',
                    '## TAG: bound tag',
                    ';String with tag',
                    'Chaîne avec étiquette',
                    '## MAX_LENGTH: 12',
                    ';Save file',
                    'Save file',
                    '## MAX_LENGTH: ABC',
                    ';Save file wrong',
                    'Save file wrong',
                    '# For translations starting with hashtags we can use a trailing space',
                    ';This is a snippet #something :)',
                    ' #something is the translated snippet',
                ],
            ],
        ];
    }

    /**
     * @dataProvider getFileDP
     */
    public function testGetFile($a, $b)
    {
        $obj = new _DotLangParser();
        $this
            ->array($obj->getFile($a))
                ->isEqualTo($b);
    }

    public function testGetFileMissing()
    {
        $obj = new _DotLangParser();
        _DotLangParser::$log_errors = false;
        $this->boolean($obj->getFile('fakefile', false))
                ->isFalse();
    }

    public function testParseFileLocale()
    {
        $obj = new _DotLangParser();

        // Load file as localized version
        $test_file = TEST_FILES . 'dotlang/toto.lang';
        $dotlang_data = $obj->parseFile($test_file);

        // Check activation status
        $this
            ->boolean($dotlang_data['activated'])
                ->isTrue();

        // Check tags
        $this
            ->array($dotlang_data['tags'])
                ->isEqualTo(['I am a tag']);

        // Check duplicates (not relevant for localized files)
        $this
            ->boolean(isset($dotlang_data['duplicates']))
                ->isFalse();

        // Check multiline strings errors
        $this
            ->array($dotlang_data['errors']['ignoredstrings'])
                ->isEqualTo(['2nd line', '3rd line']);

        // Check translation of one string
        $this
            ->string($dotlang_data['strings']['Hello'])
                ->isEqualTo('Bonjour');

        // Check translation of snippet starting with #
        $this
            ->string($dotlang_data['strings']['This is a snippet #something :)'])
                ->isEqualTo('#something is the translated snippet');

        // Check fallback to English for missing translation
        $this
            ->string($dotlang_data['strings']['Empty string'])
                ->isEqualTo('Empty string');
    }

    public function testParseFileEnglish()
    {
        $obj = new _DotLangParser();

        /* Load file as English. Some info (comments, bound tags)
         * are extracted only for English
         */
        $test_file = TEST_FILES . 'dotlang/toto.lang';
        $dotlang_data = $obj->parseFile($test_file, true);

        // Check file description
        $this
            ->array($dotlang_data['filedescription'])
                ->isEqualTo(['I am metadata']);

        // Check file stage URL
        $this
            ->string($dotlang_data['url'])
                ->isEqualTo('https://www-dev.allizom.org/about/history');

        // Check comments
        $this
            ->integer(count($dotlang_data['comments']))
                ->isEqualTo(3);
        $this
            ->string($dotlang_data['comments']['Browser'][0])
                ->isEqualTo('I am a comment');

        // Check duplicates
        $this
            ->boolean(in_array('Hello', $dotlang_data['duplicates']))
                ->isTrue();

        // Check multiline strings errors
        $this
            ->array($dotlang_data['errors']['ignoredstrings'])
                ->isEqualTo(['2nd line', '3rd line']);

        // Check bound tags
        $this
            ->integer(count($dotlang_data['tag_bindings']))
                ->isEqualTo(1);
        $this
            ->string($dotlang_data['tag_bindings']['String with tag'])
                ->isEqualTo('bound tag');

        // Check character limits
        $this
            ->integer(count($dotlang_data['max_lengths']))
                ->isEqualTo(2);
        $this
            ->integer($dotlang_data['max_lengths']['Save file'])
                ->isEqualTo(12);

        $this
            ->integer($dotlang_data['max_lengths']['Save file wrong'])
                ->isEqualTo(0);

        // Test a second file only with comments
        $test_file = TEST_FILES . 'dotlang/test_comments.lang';
        $dotlang_data = $obj->parseFile($test_file, true);
        $this
            ->integer(count($dotlang_data['comments']))
                ->isEqualTo(2);

        $this
            ->integer(count($dotlang_data['comments']['Mail']))
                ->isEqualTo(2);

        $this
            ->string($dotlang_data['comments']['Mail'][1])
                ->isEqualTo('Second comment');
    }

    public function testgetMetaTags()
    {
        $obj = new _DotLangParser();
        $this
            ->array($obj->getMetaTags())
                ->isEqualTo(['## NOTE:', '## TAG:', '## MAX_LENGTH:', '## URL:']);
    }
}
