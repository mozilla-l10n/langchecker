<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\LangManager as _LangManager;

require_once __DIR__ . '/../bootstrap.php';

class LangManager extends atoum\test
{
    public function testAnalyzeLangFile()
    {
        require_once TEST_FILES . 'config/sources.php';
        $obj = new _LangManager();

        $reference_data = $obj->loadSource($sites[2], 'en-US', 'page.lang');
        $locale_data = $obj->loadSource($sites[2], 'it', 'page.lang');
        $analysis_data = $obj->analyzeLangFile($sites[2], 'it', 'page.lang', $reference_data);

        $this
            ->boolean($analysis_data['activated'])
                ->isTrue();

        // Identical should be equal to 2, also empty string is considered identical
        $this
            ->integer(count($analysis_data['Identical']))
                ->isEqualTo(2);

        $this
            ->integer(count($analysis_data['Missing']))
                ->isEqualTo(1);

        $this
            ->integer(count($analysis_data['Obsolete']))
                ->isEqualTo(1);

        $this
            ->integer(count($analysis_data['Translated']))
                ->isEqualTo(8);

        $this
            ->integer(count($analysis_data['python_vars']))
                ->isEqualTo(1);

        $this
            ->string($analysis_data['python_vars']['String with %(num)s tags']['text'])
                ->isEqualTo('Stringa con etichette e variabile sbagliata');

        $this
            ->string($analysis_data['python_vars']['String with %(num)s tags']['var'])
                ->isEqualTo('%(num)s');

        $this
            ->boolean($obj->isStringLocalized('Hello', $locale_data, $reference_data))
                ->isTrue();

        $this
            ->boolean($obj->isStringLocalized('Test', $locale_data, $reference_data))
                ->isFalse();
    }


    public function testBuildLangFile()
    {
        require_once TEST_FILES . 'config/sources.php';
        $obj = new _LangManager();

        $reference_data = $obj->loadSource($sites[2], 'en-US', 'page.lang');
        $locale_data = $obj->loadSource($sites[2], 'it', 'page.lang');

        $updated_content = $obj->buildLangFile($reference_data, $locale_data, 'it', "\n");
        $comparison_content = file_get_contents(TEST_FILES . 'dotlang/it/updated_page.lang');

        $this
            ->boolean($updated_content == $comparison_content)
                ->isTrue();
    }

    public function testLoadPoFile()
    {
        $filepath = TEST_FILES . 'gettext/test.po';
        $obj = new _LangManager();

        $strings = $obj->loadPoFile($filepath);

        // Total number of strings
        $this
            ->integer(count($strings))
                ->isEqualTo(7);

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
}
