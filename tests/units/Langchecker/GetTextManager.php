<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\DotLangParser as _DotLangParser;
use Langchecker\GetTextManager as _GetTextManager;

require_once __DIR__ . '/../bootstrap.php';

class GetTextManager extends atoum\test
{
    public function testLoadPoFile()
    {
        $filepath = TEST_FILES . 'gettext/test.po';
        $obj = new _GetTextManager();

        $strings = $obj->loadPoFile($filepath);

        // Total number of strings
        $this
            ->integer(count($strings))
                ->isEqualTo(9);

        // Identical string
        $this
            ->string($strings['Download'])
                ->isEqualTo('Download {ok}');

        // Single line string
        $this
            ->string($strings['Different by Design'])
                ->isEqualTo('De todos. Para todos');

        // Multiline string
        $this
            ->string($strings['As a non-profit, we’re free to innovate on your behalf without any pressure to compromise.'])
                ->isEqualTo('Como una organización sin fines de lucro, somos libres de innovar en tu nombre sin presión o compromiso alguno.');
    }

    public function testImportLocalPoFile()
    {
        $po_filepath = TEST_FILES . 'gettext/test.po';
        $lang_filepath = TEST_FILES . 'gettext/test.lang';
        $obj = new _GetTextManager();

        $locale_data = _DotLangParser::parseFile($lang_filepath, false);
        $po_import = $obj->importLocalPoFile($po_filepath, $locale_data, false);

        // I should have imported data
        $this
            ->boolean($po_import['imported'])
                ->isTrue();

        // I should have one error
        $this
            ->integer(count($po_import['errors']))
                ->isEqualTo(1);

        // Test one translated string
        $this
            ->string($po_import['strings']['Innovating <span>for you</span>'])
                ->isEqualTo('¡Inovando <span>para ti!</span>');

        // Test one translated string in both lang and po file (second has precedence)
        $this
            ->string($po_import['strings']['Fast, flexible, <span>secure</span>'])
                ->isEqualTo('Rápido, flexible, seguro');

        // Empty translation in .po file, existing in .lang file
        $this
            ->string($po_import['strings']['Empty'])
                ->isEqualTo('test');

        // Test one identical string
        $this
            ->string($po_import['strings']['Download'])
                ->isEqualTo('Download {ok}');

        // Test one translation starting with ; (should be ignored)
        $this
            ->string($po_import['strings']['Download test'])
                ->isEqualTo('Download test');
    }
}
