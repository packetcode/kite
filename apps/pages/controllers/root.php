<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/
defined('_KITE') or die;
//package - apps/pages/controllers/root.php
// Pages application class
class PagesControllerRoot
{

	function main()
	{
		KITE::render('wall');
	}
	
	function about()
	{
		$basket = KITE::getInstance('basket');
		$basket->set('title','About Page');
		$content = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.";
		$basket->set('content',$content);
		KITE::render('about');
	}
	
	function services()
	{
		$option=array("username"=>"shaadomanthra");
		$data = kite::connect('user','getname');
	//	var_Dump($data);

		KITE::render('services');
	}
	
	function contact()
	{
		KITE::render('contact');
	}
	
	function name()
	{
		$basket = kite::getInstance('basket');
		$basket->set('name','teja');
	}

}


?>
