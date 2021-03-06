<?php
namespace Home\Controller;
use Think\Controller;


class IndexController extends Controller {
    
    public function index(){ 


       $cache_a= S('site_name');

       if (empty($cache_a)) {
         $system_info=M('System_conf')->find();
         $cache_a=S('site_name',$system_info);
       }
        
       $this->assign('title','首页 - '.$cache_a['site_name']);
       $this->display();
    }

    public function about_us()
    {

       $cache_a= S('site_name');
       $this->assign('title','关于我们 - '.$cache_a['site_name']);

    	// do it
       $this->display();
    	
    }

 	  public function contact_us()
    {
       $cache_a= S('site_name');

       $this->assign('title','联系我们 - '.$cache_a['site_name']);
    	// do it
       $this->display();
    	
    }
    public function news()
    {
//新增加
		$news = M('News');
		
		$page_cout=6;
		
		$page_num=I('page_num')>0?I('page_num'):1;
		
		
		$start_index=($page_num-1)*$page_cout;
//		$start_index=0;
		
		$news_list=$news->limit($start_index,$page_cout)->select();

		$this->assign('news_list',$news_list);
		
//		select count(*) from News
		$news_total_num=$news->count();
//		总页数
		$total_num=ceil($news_total_num/$page_cout);
		$cur_page_style;
		for($i=1;$i<=$total_num;$i++){
			if($page_num==$i){
				$cur_page_style="style='background-color: #000000;color: #FFFFFF'";

			}

			$page_html.="<a ".$cur_page_style." class='btn' href=".U('Index/news',array('page_num'=>$i)).">$i</a>&nbsp;&nbsp;&nbsp;";
			$cur_page_style='';
			
		}
		$this->assign('page_html',$page_html);

//新增加
       $cache_a= S('site_name');
       $this->assign('title','新闻列表 - '.$cache_a['site_name']);
    	// do it 
       $this->display();
    	
    }
    public function login()
    {
       $cache_a= S('site_name');
       $this->assign('title','登录 - '.$cache_a['site_name']);
    	// do it
       $this->display();
    	
    }
    public function register()
    {
       $cache_a= S('site_name');
       $this->assign('title','注册 - '.$cache_a['site_name']);

    	// do it
       $this->display();
    	
    }
    
	public function news_detail()
    {
    	$id = I('id');
		
    	$news = M('News');
		
		$news_detail = $news -> join('author') -> where('news.id='.$id.' AND author.id=author_id') -> select();
		
		$this -> assign('news_detail',$news_detail);
    	
       $cache_a= S('site_name');
       $this->assign('title','新闻详情 - '.$cache_a['site_name']);

    	// do it
       $this->display();
    	
    }
}