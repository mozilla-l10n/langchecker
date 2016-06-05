<?php
namespace tests\units\Langchecker;

use atoum;
use Langchecker\Bugzilla as _Bugzilla;

require_once __DIR__ . '/../bootstrap.php';

class Bugzilla extends atoum\test
{
    public function getNewBugLinkDP()
    {
        return [
            [
                'it',
                'it%20%2F%20Italian',
                'opt-in',
                ['firefox/new.lang'],
                'https://bugzilla.mozilla.org/enter_bug.cgi?alias=&assigned_to=pmo%40mozilla.com&cc=francesco.lodolo%40gmail.com&blocked=&bug_file_loc=http%3A%2F%2F&bug_severity=normal&bug_status=NEW&component=L10N&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text%2Fplain&data=&dependson=&description=&flag_type-4=X&flag_type-418=X&flag_type-419=X&flag_type-506=X&flag_type-507=X&form_name=enter_bug&keywords=&maketemplate=Remember%20values%20as%20bookmarkable%20template&op_sys=All&priority=--&product=www.mozilla.org&rep_platform=All&short_desc=%5Bl10n%3A+it%5D+Add+opt-in+pages+to+%27it%27&target_milestone=---&version=Development%2FStaging&format=__default__&cf_locale=it%20%2F%20Italian&comment=',
            ],
            [
                'fr',
                'fr%20%2F%20French',
                'upload',
                ['firefox/new.lang'],
                'https://bugzilla.mozilla.org/enter_bug.cgi?alias=&assigned_to=pmo%40mozilla.com&cc=francesco.lodolo%40gmail.com&blocked=&bug_file_loc=http%3A%2F%2F&bug_severity=normal&bug_status=NEW&component=L10N&contenttypeentry=&contenttypemethod=autodetect&contenttypeselection=text%2Fplain&data=&dependson=&description=&flag_type-4=X&flag_type-418=X&flag_type-419=X&flag_type-506=X&flag_type-507=X&form_name=enter_bug&keywords=&maketemplate=Remember%20values%20as%20bookmarkable%20template&op_sys=All&priority=--&product=www.mozilla.org&rep_platform=All&short_desc=%5Bl10n%3A+fr%5D+Updated+file+%27firefox%2Fnew.lang%27+for+GitHub+repository&target_milestone=---&version=Development%2FStaging&format=__default__&cf_locale=fr%20%2F%20French&comment=%28Attach+your+updated+firefox%2Fnew.lang+file+to+this+bug+or+indicate+the+changeset+of+your+commit+in+GitHub%29',
            ],
        ];
    }

    /**
     * @dataProvider getNewBugLinkDP
     */
    public function testGetNewBugLink($a, $b, $c, $d, $e)
    {
        $obj = new _Bugzilla();
        $this
            ->string($obj->getNewBugLink($a, $b, $c, $d))
                ->isEqualTo($e);
    }
}
