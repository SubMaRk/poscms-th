<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade extends M_Controller {

    private $rid;
    private $version;

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        $this->version = DR_VERSION;
    }

    /**
     * 程序管理
     */
    public function index() {

        $this->template->assign(array(
            'menu' => $this->get_menu_v3(array(
                fc_lang('程序管理') => array('admin/upgrade/index', 'plug'),
            )),
        ));
        $this->template->display('upgrande.html');
    }

    // 版本列表
    public function vlist() {

        $data = dr_catcher_data('http://www.poscms.net/index.php?c=fc&m=newlist&my='.(DR_VERSION_ID).'&domain='.dr_cms_domain_name($this->site_info[1]['SITE_URL']));

        if (!$data) {
            exit('<p style="color:red;"> <a href="http://www.poscms.net/index.php?s=help&c=doc&m=bdb" target="_blank">单击前往下载补丁包！</a> </p>');
        }

        $rt = dr_object2array(json_decode($data));
        if (!$rt) {
            exit('<p style="color:red;"> 返回数据不规范，请联系官方！ </p>');
        }

        $this->template->assign('rt', $rt);
        $this->template->display('upgrande_vlist.html');exit;
    }


}