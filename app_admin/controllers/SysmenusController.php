<?php
class SysMenusController extends ControllerBase{
	// Index
	public function indexAction(){
		// Page
		if(isset($_GET['search'])){
			$like = $this->inc->pageWhere();
			$where = '';
			foreach ($like['data'] as $key => $val){
				$where .= $key." LIKE '%".$val."%' AND ";
			}
			$where = rtrim($where,'AND ');
			$data = Menus::find(array($where,'order'=>'fid desc,sort desc'));
			$getUrl = $like['getUrl'];
		}else{
			$getUrl = '';
			$data = Menus::find(array('order'=>'fid desc,sort desc'));
		}
		$page = $this->inc->getPage(array('data'=>$data,'getUrl'=>$getUrl));
		$this->view->setVar('Page', $page);
		// Menus
		$this->view->setVar('Menus',$this->inc->getMenus());
		$this->tag->prependTitle($this->inc->Ctitle);
		// Data
		$this->view->setVar('MenusLang',$this->inc->getLang('menus'));
		$this->view->setVar('Lang',$this->inc->getLang('system/sys_menu'));
		$this->view->setVar('LoadJS', array('system/sys_menus.js'));
		// View
		$this->view->setTemplateAfter(APP_THEMES.'/main');
		$this->view->pick("system/menus/index");
	}
	// Search
	public function seaAction(){
		$this->view->setVar('Lang',$this->inc->getLang('system/sys_menu'));
		$this->view->pick("system/menus/sea");
	}
}