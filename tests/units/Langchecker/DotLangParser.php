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
                    '# I am a comment',
                    ';Browser',
                    'Navigateur',
                    ';Mail',
                    'Courrier',
                    '# another comment',
                    ';Hello',
                    'Bonjour',
                    ';Empty string',
                    '## TAG: bound tag',
                    ';String with tag',
                    'Chaîne avec étiquette',
                ]
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
        $this
            ->boolean($obj->getFile('fakefile', false))
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

        // Check file description
        $this
            ->array($dotlang_data['filedescription'])
                ->isEqualTo(['I am metadata']);

        // Check tags
        $this
            ->array($dotlang_data['tags'])
                ->isEqualTo(['I am a tag']);

        // Check translation of one string
        $this
            ->string($dotlang_data['strings']['Hello'])
                ->isEqualTo('Bonjour');

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

        // Check comments
        $this
            ->integer(count($dotlang_data['comments']))
                ->isEqualTo(2);
        $this
            ->string($dotlang_data['comments']['Browser'][0])
                ->isEqualTo('I am a comment');

        // Check bound tags
        $this
            ->integer(count($dotlang_data['tag_bindings']))
                ->isEqualTo(1);
        $this
            ->string($dotlang_data['tag_bindings']['String with tag'])
                ->isEqualTo('bound tag');
    }
}
