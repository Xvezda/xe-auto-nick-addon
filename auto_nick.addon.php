<?php
/* Copyright (C) Xvezda <http://xvezda.blog.me> */

if(!defined('__XE__'))
{
	exit();
}

/**
 * @file auto_nick.addon.php
 * @author Xvezda (xvezda@naver.com)
 * @brief Add-on to auto input guest nickname
 */
if($called_position == 'after_module_proc' && Context::get('module') != 'admin' && (Context::getResponseMethod() == 'HTML' || !isCrawler()))
{
	if(Context::get('logged_info')) return;
	if(Context::get('act') == 'dispMemberSignUpForm') return;

	if(in_array(Context::get('act'), array('procBoardInsertDocument', 'procBoardInsertComment')))
	{
		setcookie('auto_nick', urlencode(Context::get('nick_name')), $_SERVER['REQUEST_TIME'] + 31536000, '/');
	}

	if($_COOKIE['auto_nick'])
	{
		Context::addHtmlFooter('<script>jQuery("input[name=nick_name]").focus().val(decodeURIComponent("'.htmlentities($_COOKIE['auto_nick']).'"));</script>');
	}
}

/* End of file auto_nick.addon.php */
/* Location: ./addons/auto_nick/auto_nick.addon.php */
