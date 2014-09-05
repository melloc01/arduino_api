<?php

			class api_arduino_control extends LoopControl
			{
				public 	$registros,
				$Form, 
				$Model, 
				$no_controls_lista,
				$list_headers,
				$list_cells;

				public function __construct($tool="api_")
				{
					parent::__construct($tool);
				}

				public function home()
				{		
		// $this->Form->setInputOrder(array("column1","column2"));
		// $this->Form->setRotuloFk("fkuser","name");
		// $this->Form->setMasks(array("title" => "Title"));
		// $this->Form->defineInput("<input />","field");
		// $this->Form->setDefaultValues("field",array("optionValue" => "optionMask","optionValue"=> "optionMask"));


					$this->list_headers = array("");
					$this->list_cells = array("{{}}");	

					$this->no_controls_lista = array(); //inicializa 
					$this->registros =  $this->Model->getRegistros();

					$this->setPageTitle("api_arduinos");
					$this->render(ADMIN."core/view/lista.php",get_defined_vars());

				}


				public function edit()
				{
					$id = $this->httpRequest->getActionValue();
					$registro = $this->Model->getRegistro($id);
					$this->setPageTitle("Editar api_arduino");
					$this->Form->setInputs($registro);

					$this->render(ADMIN."core/view/editar.php",get_defined_vars());
				}

				public function create()
				{
					$this->setPageTitle("Novo api_arduino");
					$this->Form->setInputs();
					$this->render(ADMIN."core/view/novo.php",get_defined_vars());
				}
			}