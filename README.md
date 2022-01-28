# user_registeration_login_system
A simple PHP application which enables user registration and user login.

Following functions are included in this application
<ul>
<li>Login / Signup</li>
<li>Logout</li>
<li>Double opt-in Email signups</li>
<li>Forgot password</li>
<li>Reset password</li>
<li>Magic Link</li>
<li>Javascript validation for all forms</li>
<li>Serverside validatio for all forms</li>
<li>Email validation js and server side</li>
<li>Responsive Design</li>
</ul>

## Table of contents

### Status

### Technologie
<ul>
<li>PHP</li> 
<li>MySQL</li> 
<li>HTML</li>
<li>CSS</li>
<li>Javascript</li>
</ul>

### Setup
Steps to create this system
<ul>
<li>Create a Database and Database Table.
<ul><li> Details given in db/log.txt</li></ul>
  </li>
<li>Connect to the Database</li>
<ul><li>  Database credentials are updated in config.php</li></ul>

<li>Session Create for Logged in User
<ul><li>  You can see session settings in below files</li>
<li> module/auth_session.php</li>
<li> login.php</li>
<li> active.php</li></ul></li>
  
<li>Create a Registration and Login Form
<ul><li> login.php
<li> registration.php</li></ul></li>

<li>Make user receives a double-opt-in email to confirm the email address. 
<ul><li> For account registration User receives  double opt-in Email signups, customers need to additionally verify their Email address by clicking on a verification link sent to their Email address.</li>
  <li>Used PHP Mail function</li>
  </ul></li>

<li>Make a Dashboard Page
<ul><li> Dashbord.php</li></ul></li>

<li>Create a Logout (Destroy session)</li>
<li>Create Password reset</li>
<li>Create Forgot Password</li>
<li>Make Login using magic link</li>
<li>CSS File Create</li>
  </ul>
  


