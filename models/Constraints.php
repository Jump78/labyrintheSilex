<?php 

namespace Models;

use Symfony\Component\Validator\Constraints as Assert;

/**
* 
*/
class Constraints
{
	private $constraint;
	
	function __construct()
	{
		$this->constraint = new Assert\Collection([
			'width' =>[
				new Assert\NotBlank(['message' => 'Veuillez renseigner la largeur du labyrinthe.']),

				new Assert\Type (['value' => 'numeric',
								  'message' => 'La largeur doit etre un nombre.'
								 ]),
				
				new Assert\Range(['minMessage' => 'La largeur doit être au minimum égale a 2.',
								  'min' => 2,
								 ])
			],

			'height' =>[
				new Assert\NotBlank(['message' => 'Veuillez renseigner la hauteur du labyrinthe.']),

				new Assert\Type (['value' => 'numeric',
								  'message' => 'La largeur doit etre un nombre.'
								 ]),
				
				new Assert\Range(['minMessage' => 'La hauteur doit être au minimum égale a 2.',
								  'min' => 2,
								  'maxMessage' => ''
								 ])
			],

			'color' => [
				new Assert\NotBlank(['message' => 'Veuillez renseigner ce champ.']),
			]	
		]);
	}

	public function get_constraint(){
		return $this->constraint;
	}
}