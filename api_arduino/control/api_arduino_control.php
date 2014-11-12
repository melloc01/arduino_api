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
			$registro = $this->Model->getRegistro('11110000','id_arduino', 'and id_interruptor = "1101" ');
			$this->render(ROOT."api_arduino/view/home.php", get_defined_vars());
		}

		public function toggleInterruptor()
		{
			//updateSensor/id_arduino/id_interruptor/valor_sensores
			$update_array = array(
				'controle' => $_POST['controle']
			);
			$sql = "UPDATE  api_arduino set controle = '{$_POST['controle']}' where id_arduino='11110000' and id_interruptor='1101' ";
			if ($this->Model->runQuery($sql))
				$_SESSION['system_success'] = "O interruptor foi atualizado com o valor <strong>{$_POST['controle']}</strong>";
			else 
				$_SESSION['system_danger'] = "Houve um erro ao atualizar o valor do interruptor.";
			$this->movePermanently('/api_arduino');
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

		public function updateControl()
		{
			//updateSensor/id_arduino/id_interruptor/valor_sensores
			$params = $this->httpRequest->getParameters();
			$id_arduino = $this->getActionValue();
			$id_interruptor = key($params);

			$interruptor = $this->Model->getRegistro($id_interruptor,'id_interruptor', "AND id_interruptor = '$id_interruptor' ");

			$update_array = array(
				'controle' => ! $interruptor['controle']
			);

			$this->Model->update($id_interruptor,$update_array,'id_interruptor') ?  "1" :  "0";

			$interruptor = $this->Model->getRegistro($id_interruptor,'id_interruptor', "AND id_interruptor = '$id_interruptor' ");
			echo (int) $interruptor['controle'];
		}

		public function html_list()
		{
			$dados = $this->Model->getRegisters();
			$this->renderPure(ROOT.'api_arduino/view/html_list.php',get_defined_vars());
		}

	}