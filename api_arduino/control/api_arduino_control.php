<?php
	class api_arduino_control extends LoopControl
	{
		public $Model;

		function __construct()
		{
			parent::__construct();
			$this->Model = new api_arduino_model();
		}

		public function home()
		{
			$this->render(ROOT."api_arduino/view/home.php", get_defined_vars());
		}

		public function create()
		{
			if (isset($_POST['dado'])) {
				$id_arduino = substr($_POST['dado'], -4);
				$dado = substr($_POST['dado'],0,-4);

				$insert_array = array(
					'dado' => $dado,
					'id_arduino' => $id_arduino
				);		
				if ($this->Model->insert($insert_array))
					echo "Success !";
				else
					echo "Failure";

			} else
				echo "You need to provide some data.";

		}

		public function readArduino()
		{
			$id_arduino = $this->getActionValue();
			$_search_array = array(
				'id_arduino' => array('operator' => '=', 'value' => "$id_arduino"),
			);
			$dados = $this->Model->getRegisters($_search_array);
			foreach ($dados as $key => $dado) {
				echo "{$dado['sensores']}{$dado['controle']}{$dado['id_interruptor']}$";
			}
		}

		public function updateSensor()
		{
			//updateSensor/id_arduino/id_interruptor/valor_sensores
			$params = $this->httpRequest->getParameters();
			$id_arduino = $this->getActionValue();

			$id_interruptor = key($params);
			$update_array = array(
				'sensores' => $params[$id_interruptor]
			);
		
			echo $this->Model->update($id_interruptor,$update_array,'id_interruptor') ?  "1" :  "0";
		}

		public function html_list()
		{
			$dados = $this->Model->getRegisters();
			$this->renderPure(ROOT.'api_arduino/view/html_list.php',get_defined_vars());
		}

	}