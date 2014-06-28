<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\DotLangParser as _DotLangParser;

require_once __DIR__ . '/../bootstrap.php';

class DotLangParser extends atoum\test
{
    public function getFileDP()
    {
        $test_file = __DIR__ . '/../../testfiles/dotlang/toto.lang';

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
            ]
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

    public function testLoadLocale()
    {
        $obj = new _DotLangParser();

        // Load file as French
        $test_file = __DIR__ . '/../../testfiles/dotlang/toto.lang';
        $GLOBALS['reflang'] = 'fr';
        $obj->load($test_file);

        // Check activation status
        $this
            ->boolean($GLOBALS['__l10n_moz']['activated'])
                ->isTrue();

        // Check file description
        $this
            ->array($GLOBALS['__l10n_moz']['filedescription'])
                ->isEqualTo(['I am metadata']);

        // Check tags
        $this
            ->array($GLOBALS['__l10n_moz']['tags'])
                ->isEqualTo(['I am a tag']);

        // Check translation of one string
        $this
            ->string($GLOBALS['__l10n_moz']['Hello'])
                ->isEqualTo('Bonjour');

        // Check fallback to English for missing translation
        $this
            ->string($GLOBALS['__l10n_moz']['Empty string'])
                ->isEqualTo('Empty string');
    }

    public function testLoadEnglish()
    {
        $obj = new _DotLangParser();

        /* Load file as English. Some info (comments, bound tags)
         * are extracted only for English
         */
        $test_file = __DIR__ . '/../../testfiles/dotlang/toto.lang';
        $GLOBALS['reflang'] = 'en-US';
        $obj->load($test_file);

        // Check comments
        $this
            ->integer(count($GLOBALS['__l10n_comments']))
                ->isEqualTo(2);
        $this
            ->string($GLOBALS['__l10n_comments']['Browser'])
                ->isEqualTo('I am a comment');

        // Check bound tags
        $this
            ->integer(count($GLOBALS['__english_moz']['tag_bindings']))
                ->isEqualTo(1);
        $this
            ->string($GLOBALS['__english_moz']['tag_bindings']['String with tag'])
                ->isEqualTo('bound tag');
    }

    public function startsWithDP()
    {
        return [
            ['test string', 't'],
            [';test string', ';'],
            ['## TAG: test string', '## TAG:'],
        ];
    }

    /**
     * @dataProvider startsWithDP
     */
    public function testStartsWith($a, $b)
    {
        $obj = new _DotLangParser();
        $this
            ->boolean($obj->startsWith($a, $b))
                ->isTrue();
    }
}
