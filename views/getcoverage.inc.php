<?php
namespace Langchecker;

print isset($_GET['locales'])
      ? getUserBaseCoverage($_GET['locales'])
      : 'ERROR: missing list of locales.';
