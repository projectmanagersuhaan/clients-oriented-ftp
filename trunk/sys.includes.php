<?php
/**
 * Requirements of basic system files.
 *
 * @package ProjectSend
 * @subpackage Core
 */

define('ROOT_DIR', dirname(__FILE__));

/** Basic system constants */
require_once(ROOT_DIR.'/sys.vars.php');

/** Load the database class */
require_once(ROOT_DIR.'/includes/classes/database.php');

/** Load the site options */
require_once(ROOT_DIR.'/includes/site.options.php');

/** Text strings used on various files */
require(ROOT_DIR.'/includes/vars.php');

/** Basic functions to be accessed from anywhere */
require_once(ROOT_DIR.'/includes/functions.php');

/** Contains the session and cookies validation functions */
require_once(ROOT_DIR.'/includes/userlevel_check.php');

/** Template list generator */
require_once(ROOT_DIR.'/includes/templates.php');

/** Contains the current session information */
require_once(ROOT_DIR.'/includes/active.session.php');

/**
 * Always require this classes to avoid repetition of code
 * on other files.
 *
 */
require_once(ROOT_DIR.'/includes/classes/actions-clients.php');
require_once(ROOT_DIR.'/includes/classes/actions-files.php');
require_once(ROOT_DIR.'/includes/classes/actions-groups.php');
require_once(ROOT_DIR.'/includes/classes/actions-log.php');
require_once(ROOT_DIR.'/includes/classes/actions-users.php');
require_once(ROOT_DIR.'/includes/classes/file-upload.php');
require_once(ROOT_DIR.'/includes/classes/form-validation.php');
require_once(ROOT_DIR.'/includes/classes/send-email.php');
?>