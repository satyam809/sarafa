<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('FROM_EMAIL','testbyconceptioni@gmail.com');
define('ADMIN_EMAIL','testbyconceptioni@gmail.com');

defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('TOKEN', 'Invalid Token');

define('ADD_SUCCESS','Record Added Successfully.');
define('EDIT_SUCCESS','Record Updated Successfully.');
define('DELETE_RECORD', 'Record Deleted Successfully.');
define('DELETE_ERROR', 'Error while record deleted.');
define('GET_ERROR', 'Data Not Found.');
define('GET_SUCCESS', 'Data Found Successfully.');
define('EDIT_ERROR', 'Error while data editing.');
define('ADD_ERROR', 'Error while record adding.');

define('ADD_ADDRESS', 'Address added successfully.');
define('UPDATE_ADDRESS', 'Address updated successfully.');
define('DELETE_ADDRESS', 'Address deleted successfully.');

define('MOBILE_NO', 'Please enter mobile no.');

define('OTP_VERIFY', 'OTP Verification Successfully.');
define('OTP_FAILED', 'OTP Not matched.');
define('SEND_OTP', 'OTP Send Successfully.');

define('MAIL_SENT', 'Mail send successfully.');
define('MAIL_FAILED', 'Opps ..NO Mail send.');
define('CHECK_MAIL', 'Please enter your registered email address.');

define('FORGOT_MSG', 'Please enter your registered email address OR mobile no. !');
define('FORGOT_MSG_SUCCESS', 'Message sent successfully !');

define('SIGNIN', 'Vendor login successfully.');
define('UNIQUE_EMAIL', 'Oops ! Email ID Already Exist.');
define('UNIQUE_MOBILE', 'Oops ! Mobile No. Already Exist.');
define('NO_VENDOR', 'Invalid Mobile No. or Password !');
define('INCOMPLTE_DETAIL', 'Please fill all details.');

define('NOT_VERIFIED', 'Vendor Not Verified');

define('LOGOUT', 'Vendor logout successfully.');
define('LOGOUT_ERROR', 'Error ! While logout.');

define('SAME_PASSWORD','Please provide different password. New password is same as old password.');
define('CHANGE_PASS', 'Password changed successfully.');
define('OLD_PASSWORD', 'Old password does not match.');

define('REGISTERD_MOBILE', 'Please enter registerd mobile number !');

define('USER_SIGNUP', 'User sign up successfully !');
define('USER_SIGNIN', 'User sign in successfully !');
define('NO_USER', 'Invalid Mobile No. or Password !');
define('LOGOUT_USER', 'User logout successfully.');
define('USER_EDIT', 'User Updated Successfully.');

define('SET_DEFAULT', 'This mobile no. is set as defualt.');
define('SET_DEFAULT_ERROR', 'Something wrong when this mobile no. is set as defualt.');

define('BLOCK', 'Record block successfully.');
define('UNBLOCK', 'Record un block successfully.');
define('BLOCK_BOY', 'You are Block ! Please contact to your vendor or Admin.');

define('STOCK_UPDATE', 'Stock updated successfully.');

define('ACCEPT', 'Order accept successfully.');
define('REJECT', 'Order reject successfully.');
define('UPDATE_ORDER', 'Order updated successfully.');

define('D_BLOCK', 'Sorry ! This delivery boy is block.');
define('NO_BOY', 'Sorry ! This delivery boy is not found.');
define('BUSY_BOY', 'Sorry ! This delivery boy is busy , Are you sure want to assign order.');
define('FREE_BOY', 'This delivery boy is available for order.');

define('ASSIGN_ORDER', 'Order assign successfully.');
define('ASSIGN_ERROR', 'Error ! while assign order.');

define('USER_FEEDBACK', 'Your Feedback Sent Successfully !');
define('USER_FEEDBACK_FAILED', 'Error ! while sent feedback.');

define('UPLOAD_DOC', 'Document uploaded successfully.');

define('LOGIN', 'Login successfully.');

define('LOGOUT_SUCCESS', 'Logout successfully.');

define('NO_DELIVERY', 'Invalid Mobile No. or Password !');

define('NO_CATEGORY', 'No Category Found.');

define('NO_PRODUCT', 'No Product Found.');

define('ADD_CART', 'Product updated on cart successfully !');
 
define('NO_ORDER', 'Your cart is empty !');

define('SMS_SERVICE', 'N');

define('CUR', '&#x20b9;');

define('ORDER_PLACE', 'Order placed Successfully.');
define('ORDER_PLACE_ERROR', 'Something wrong when order placed !.');

/*------------------------------ CI crediantial ------------------------------- */
// define('NOTIFICATION_KEY','AAAA2B3JFLI:APA91bGs98tupwJB0SpVapgnvqoKGn3jA0OlxkqpnNZKZuIaCi7Lymro0M9DiraEUdDxCg7NJhIGT7ctvXbKm5992-hzTvB2PK1ll_g0ZMUHgdms6LLS7J-HPDHUiyeqx6kox_MpDg-V');

// define('PUSH_NOTIFICATION_KEY','AAAAczNuDR0:APA91bE4e5dhC4DptfLG6Nls9fMuXLzULrhbeGg5aCTbM2Uc5_EnvQS-MRtWE4n1Yk19WXTPM_XPKCClobj5AtqQ2hSpdOGb2v45FvQeuBJFk7-oSyA13WHYu18Ca2YJKzRZqokcV739');

// define('PUSH_NOTIFICATION_KEY_USER', 'AAAA5kBHdNc:APA91bHx8G_PEeoMWUUDBbysCW-8LidfTJ_QcEVWHBIzxVMyHVsQZonZBxY6SBKzn7vfVNenFNSUXGQ7-iDnkPmcr-kUhqJVJDduyGeoYvcaTEOAbUO828xmLy5VB03g9zvi8DvfdSLO');

// define('NOTIFICATION_KEY','AAAAOor1298:APA91bHu6rDJRtHTk9Fgef6jNrTBRHymDg0f9F-1b9byqriP_xQ9B7TzgPmn6HlAodyQiICjaqvn30ZwPnvzSGtZ9nIRZVwlxAIyd_PBnuYH8G6H4pj0VycVjm4njHJylj06OL8XfdTz');

define('NOTIFICATION_KEY','AAAA8vNBVgQ:APA91bGu-_FB23N019km0Fo5B8fzogFQdxGzL006T71fqVgURhzpILv24ZyVqR56b5lC8lP82rF4r4e0ixeu7vPnHznupfpSJyTp6OFrgnz3OubzzD-5DGG8P_eSxPc7guV_dQccdPq-');

define('PUSH_NOTIFICATION_KEY','AAAAOor1298:APA91bHu6rDJRtHTk9Fgef6jNrTBRHymDg0f9F-1b9byqriP_xQ9B7TzgPmn6HlAodyQiICjaqvn30ZwPnvzSGtZ9nIRZVwlxAIyd_PBnuYH8G6H4pj0VycVjm4njHJylj06OL8XfdTz');

define('PUSH_NOTIFICATION_KEY_USER', 'AAAAOor1298:APA91bHu6rDJRtHTk9Fgef6jNrTBRHymDg0f9F-1b9byqriP_xQ9B7TzgPmn6HlAodyQiICjaqvn30ZwPnvzSGtZ9nIRZVwlxAIyd_PBnuYH8G6H4pj0VycVjm4njHJylj06OL8XfdTz');

define('SERVER_KEY','mpPo9hSKyVjJOkQFSus6dMiernM5QBLDI662nEyiJJ3RRP8cp0xV7G3AC30G');

// /* Google App Client Id DEV */
// define('CLIENT_ID', '235405485228-415e2i568k9q2k2h0rj7q0rj25c98qqr.apps.googleusercontent.com');

// /* Google App Client Secret DEV */
// define('CLIENT_SECRET', 'yLBIPg-M6-7l5bUvtygpXzsp');

/* Google App Client Id PROD */
define('CLIENT_ID', '965994175131-b72hqp3b7mmf2ksne9pdujb7lomnqvnm.apps.googleusercontent.com');

/* Google App Client Secret PROD */
define('CLIENT_SECRET', 'r9gSt_4nxD9zGUNsvg7-j-fk');

define('GEOCODE_KEY','AIzaSyCztEXYhg-aBuPv1mpTYjxvvESpvA6nqgA');

/* Google App Redirect Url */
define('CLIENT_REDIRECT_URL', 'https://cidev.in/vruits/login');
define('CLIENT_REDIRECT_URL_REGISTER', 'https://cidev.in/vruits/register');