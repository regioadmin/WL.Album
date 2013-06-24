<?php
namespace WL\Album\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WL.Album".               *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * An Album
 *
 * @Flow\Entity
 */
class Album {

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * some float
	 * @var float
	 * @ORM\Column(type="decimal", nullable=TRUE, precision=13, scale=2,options={"default" = 0})
	 */
	protected $amount;

	/**
	 * @ORM\ManyToMany(cascade={"persist"})
	 * @var \Doctrine\Common\Collections\Collection<\TYPO3\Media\Domain\Model\Image>
	 */
	protected $image;

	/**
	 * Get the Album's name
	 *
	 * @return string The Album's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Album's name
	 *
	 * @param string $name The Album's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}


	/**
	 * @param  \Doctrine\Common\Collections\Collection<\TYPO3\Media\Domain\Model\Image> $image
	 * param  \TYPO3\Media\Domain\Model\Image $image
	 *
	 * return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}


	/**
	 * @return \Doctrine\Common\Collections\Collection<\TYPO3\Media\Domain\Model\Image>
	 * return \TYPO3\Media\Domain\Model\Image
	 */
	public function getImage() {
		return $this->image;
	}


	/**
	 * @param float $amount
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
	}

	/**
	 * @return float
	 */
	public function getAmount() {
		return $this->amount;
	}

	public function __construct() {
//prevent error when uploadfield empty
		$this->image = new \Doctrine\Common\Collections\ArrayCollection();
	}
}
?>