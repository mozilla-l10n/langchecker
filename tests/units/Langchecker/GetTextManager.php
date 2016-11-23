<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\DotLangParser as _DotLangParser;
use Langchecker\GetTextManager as _GetTextManager;

require_once __DIR__ . '/../bootstrap.php';

class GetTextManager extends atoum\test
{
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

        // White spaces should be trimmed
        $this
            ->string($po_import['strings']['Download2'])
                ->isEqualTo('Download');

        // Test one identical string
        $this
            ->string($po_import['strings']['Download'])
                ->isEqualTo('Download {ok}');

        // Test translation starting with ; (should be ignored)
        $this
            ->string($po_import['strings']['Download test'])
                ->isEqualTo('Download test');

        // Test empty string (lang file should not be changed)
        $this
            ->string($po_import['strings']['EmptyPO'])
                ->isEqualTo('Something');
    }
}
