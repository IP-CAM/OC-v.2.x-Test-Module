<?php
class ControllerExtensionModuleMymodule extends Controller {
    private $error = array();
	
	public function index() {
		$this->language->load('extension/module/mymodule');
		
		$data['heading_title'] = $this->language->get('error_permission');
		
        $data['column_left'] = $this->load->controller('common/column_left');
		
		$data['header']      = $this->load->controller('common/header');
        $data['footer']      = $this->load->controller('common/footer');
        $data['column_left'] = $this->load->controller('common/column_left');

        $this->response->setOutput($this->load->view('extension/module/mymodule', $data));
	}
	
	public function install() {
        $this->model_setting_setting->editSetting('mymodule', array("mymodule_status" => 1));
    }

    public function uninstall() {
        $this->model_setting_setting->deleteSetting('mymodule');
    }
	
	protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/mymodule')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}