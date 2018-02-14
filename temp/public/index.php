<?php
xhprof_enable();
try {
	define('APPLICATION_PATH', dirname(__FILE__)."/../");
	$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");
	$application->bootstrap()->run();
} catch ( Exception $e ){
	echo json_encode( array('errno'=>-999999, 'errmsg'=>'error.'.$e->getMessage()) );
}

$xhprofData = xhprof_disable();

$XHPROF_ROOT = "/home/work/imooc/application/library/ThirdParty";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

// save raw data for this profiler run using default
// implementation of iXHProfRuns.
$xhprof_runs = new XHProfRuns_Default();

// save the run under a namespace "xhprof_foo"
$run_id = $xhprof_runs->save_run($xhprofData, "xhprof_foo");
header( "XhprofID:". $run_id );
?>
