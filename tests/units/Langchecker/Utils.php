<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\Utils as _Utils;

require_once __DIR__ . '/../bootstrap.php';

class Utils extends atoum\test
{
    public function leftStripDP()
    {
        return [
            [' test string', '', 'test string'],
            ['; test string', ';', 'test string'],
            ['## TAG: test_tag', '## TAG:', 'test_tag'],
            ['# comment', '#', 'comment'],
        ];
    }

    /**
     * @dataProvider leftStripDP
     */
    public function testLeftStrip($a, $b, $c)
    {
        $obj = new _Utils();
        $this
            ->string($obj->leftStrip($a, $b))
                ->isEqualTo($c);
    }

    public function cleanStringDP()
    {
        return [
            [' test string', 'test string'],
            ['test string {ok} ', 'test string'],
            ['test string {OK} ', 'test string'],
            ['test string{ok} ', 'test string'],
            ['test string{OK}', 'test string'],
        ];
    }

    /**
     * @dataProvider cleanStringDP
     */
    public function testCleanString($a, $b)
    {
        $obj = new _Utils();
        $this
            ->string($obj->cleanString($a))
                ->isEqualTo($b);
    }

    public function startsWithDP()
    {
        return [
            ['test string', 't', true],
            [';test string', ';', true],
            ['## TAG: test string', '## TAG:', true],
            ['test string', ['t'], true],
            ['## TAG: test string', ['## TAG:', '## NOTE:'], true],
            ['## active ##', ['## TAG:', '## NOTE:'], false],
        ];
    }

    /**
     * @dataProvider startsWithDP
     */
    public function testStartsWith($a, $b, $c)
    {
        $obj = new _Utils();
        $this
            ->boolean($obj->startsWith($a, $b))
                ->isEqualTo($c);
    }

    public function getLengthDP()
    {
        return [
            ['Le cheval  blanc ', 17],
            ['મારુ ઘર પાનું બતાવો', 19],
        ];
    }

    /**
     * @dataProvider getLengthDP
     */
    public function testGetLength($a, $b)
    {
        $obj = new _Utils();
        $this
            ->integer($obj->getLength($a))
                ->isEqualTo($b);
    }

    public function secureTextDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            ['test%0D', false, 'test'],
            ['%0Atest', false, 'test'],
            ['%0Ate%0Dst', false, 'test'],
            ['%0Ate%0Dst', true, 'test'],
            ['&test', false, '&amp;test'],
            [['test%0D', '%0Atest'], false, 'test'],
        ];
    }

    /**
     * @dataProvider secureTextDP
     */
    public function testsecureText($a, $b, $c)
    {
        $obj = new _Utils();
        $this
            ->string($obj->secureText($a, $b))
                ->isEqualTo($c);
    }

    public function secureTextArrayDP()
    {
        require_once TEST_FILES . 'config/sources.php';

        return [
            [['test%0D', '%0Atest'], true, ['test', 'test']],
        ];
    }

    /**
     * @dataProvider secureTextArrayDP
     */
    public function testsecureTextArray($a, $b, $c)
    {
        $obj = new _Utils();
        $this
            ->array($obj->secureText($a, $b))
                ->isEqualTo($c);
    }

    public function highlightPythonVarDP()
    {
        return [
            ['test string', 'test string'],
            ['test %(var)s', 'test <em>%(var)s</em>'],
        ];
    }

    /**
     * @dataProvider highlightPythonVarDP
     */
    public function testHighlightPythonVar($a, $b)
    {
        $obj = new _Utils();
        $this
            ->string($obj->highlightPythonVar($a))
                ->isEqualTo($b);
    }

    public function isUTF8DP()
    {
        $base_folder = TEST_FILES . 'dotlang/';

        return [
            [$base_folder . 'toto.lang', true],
            [$base_folder . 'notutf8.lang', false],
        ];
    }

    /**
     * @dataProvider isUTF8DP
     */
    public function testIsUTF8($a, $b)
    {
        $obj = new _Utils();
        $this
            ->boolean($obj->isUTF8($a))
                ->isEqualTo($b);
    }

    public function checkEOLDP()
    {
        $base_folder = TEST_FILES . 'dotlang/';

        return [
            [$base_folder . 'toto.lang', "\n"],
            [$base_folder . 'toto_win_eol.lang', "\r\n"],
        ];
    }

    /**
     * @dataProvider checkEOLDP
     */
    public function testCheckEOL($a, $b)
    {
        $obj = new _Utils();
        $file_content = file($a);
        $this
            ->string($obj->checkEOL($file_content[0]))
                ->isEqualTo($b);
    }

    public function testFileForceContent()
    {
        $obj = new _Utils();

        $base_folder = TEST_FILES . 'dotlang/temp/';
        $file_name = 'test_forced.lang';
        $path = $base_folder . $file_name;
        $content = "Just a test";

        // File should not exist before the test
        $this
            ->boolean(file_exists($path))
                ->isFalse();

        $obj->fileForceContent($path, $content);

        // File should exist now
        $this
            ->boolean(file_exists($path))
                ->isTrue();

        // Delete the file and the folder
        unlink($path);
        rmdir($base_folder);
    }

    public function testGetQueryParam()
    {
        $obj = new _Utils();

        $_GET['test_string'] = 'test';
        $_GET['test_bool'] = true;

        // Missing string param
        $this
            ->string($obj->getQueryParam('foo'))
                ->isEqualTo('');

        // Missing string param with fallback
        $this
            ->string($obj->getQueryParam('foo', 'bar'))
                ->isEqualTo('bar');

        // Existing param
        $this
            ->string($obj->getQueryParam('test_string'))
                ->isEqualTo('test');

        // Existing param
        $this
            ->boolean($obj->getQueryParam('test_bool', false))
                ->isTrue();

        // Missing boolean param
        $this
            ->boolean($obj->getQueryParam('foo', false))
                ->isFalse();

        unset($_GET['test_string']);
        unset($_GET['test_bool']);
    }

    public function testGetCliParam()
    {
        $obj = new _Utils();

        $options = [
            1 => 'test',
        ];

        // Missing string param
        $this
            ->string($obj->getCliParam(2, $options))
                ->isEqualTo('');

        // Missing string param with fallback
        $this
            ->string($obj->getCliParam(2, $options, 'foo'))
                ->isEqualTo('foo');

        // Existing param
        $this
            ->string($obj->getCliParam(1, $options, 'foo'))
                ->isEqualTo('test');
    }
}
