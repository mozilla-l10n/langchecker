<?php
namespace Langchecker\tests\units;

use atoum;

require_once __DIR__ . '/../bootstrap.php';

class DotLangParser extends atoum\test
{
    public function getFileDP()
    {
        $test_file = __DIR__ . '/../../testfiles/dotlang/toto.lang';

        return array(
            [
                $test_file,
                [
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
                ]
            ]
        );
    }

    /**
     * @dataProvider getFileDP
     */
    public function testGetFile($a, $b)
    {
        $obj = new \Langchecker\DotLangParser();
        $this
            ->array($obj->getFile($a))
                ->isEqualTo($b);
    }
}
