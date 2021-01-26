<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Reset Your Password</title>
	</head>
	<body style="padding: 2em;">
		<?php
			$db = \Config\Database::connect();
			$builder = $db->table('user')->where('email', $email);
			$result = $builder->get();
			foreach ($result->getResult() as $row) {
		?>
		<div style="background-color: white;padding: 1em;font-family:Helvetica Neue, Helvetica, Roboto, Arial, sans-serif;">
			<h1>Password reset requested for your <?=$sitename?> Account</h1>
			<p style="margin:10px 0 10px 0;color:#565a5c;font-size:18px;">Hi <?=$row->name?>,</p>
			<p style="margin:10px 0 10px 0;color:#565a5c;font-size:18px;">We got a request to reset your <?=$sitename?> password.</p>
			<p><a href="<?=site_url() . 'admin/recover?email='.$email.'&code='.$code?>" rel="nofollow" style="color:#3b5998;text-decoration:none;display:block;" target="_blank"><font size="3"><span style="white-space:nowrap;font-weight:bold;vertical-align:middle;color:#fdfdfd;font-size:16px;line-height:16px;border-collapse: collapse;border-radius: 3px;text-align: center;display: block;border: solid 1px #009fdf;padding: 10px 16px 14px 16px;margin: 0 2px 0 auto;min-width: 80px;background-color:#47A2EA;">Reset&nbsp;Password</span></font></a></p>
			<p style="margin:10px 0 10px 0;color:#565a5c;font-size:18px;">If you ignore this message, your password will not be changed. If you didn't request a password reset, <a href="" rel="nofollow" style="color:#3b5998;text-decoration:none;" target="_blank">let us know</a>.</p>
			<div style="color:#abadae;font-size:11px;margin:0 auto 5px auto;">
				<?=COPYRIGHT?> © <?=date('Y')?>. All Rights Reserved.<br>
			</div>
			<div style="color:#abadae;font-size:11px;margin:0 auto 5px auto;">
				This message was sent to <a rel="nofollow" style="color:#abadae;text-decoration:underline;"><?=$email?></a> and intended for xqip. Not your account? <a href="" rel="nofollow" style="color:#abadae;text-decoration:underline;" target="_blank">Remove your email</a> from this account.<br>
			</div>
		</div>
		<?php
			}
		?>
	</body>
</html>