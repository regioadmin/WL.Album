<?php
namespace WL\Album\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WL.Album".               *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \WL\Album\Domain\Model\Album;

/**
 * Album controller for the WL.Album package
 *
 * @Flow\Scope("singleton")
 */
class AlbumController extends ActionController {
	/**
	 * @Flow\Inject
	 * @var \WL\Album\Domain\Repository\AlbumRepository
	 */
	protected $albumRepository;

  /**
	 * @Flow\Inject
	 * @var \TYPO3\Media\Domain\Repository\ImageRepository
	 */
	protected $imageRepository;



	/**
	 * Shows a list of details
	 *
	 * @return void
	 */
	public function indexAction() {
    	$albums=$this->albumRepository->findAll();
		$this->view->assign('albums',$albums );
	}


		/**
	 * Shows a form for creating a new detail object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Inits a form for creating a new detail object
	 *
	 * @return void
	 */
	public function initializeCreateAction(){
	 //die(\TYPO3\Flow\var_dump($this->arguments['newAlbum']));
		$albumConfiguration = $this->arguments['newAlbum']->getPropertyMappingConfiguration();
		//\TYPO3\Flow\var_dump($albumConfiguration);
        $albumConfiguration->allowProperties('name');
	}

	/**
	 * Adds the given new albumdetail to the repository
	 *
	 * @param \WL\Album\Domain\Model\Album $newAlbum
	 * @param string $name
	 * @Flow\Validate(argumentName="name", type="\TYPO3\Media\Validator\ImageTypeValidator", options={ "allowedTypes"={"jpeg", "png", "gif"} })
	 * @return void
	 */
	public function createAction(\WL\Album\Domain\Model\Album $newAlbum, $name='') {



		$this->albumRepository->add($newAlbum);
		$this->persistenceManager->persistAll();

		$this->redirect('index', 'Album');
	}

	/**
	 * @return void
	 */

	public function initializeAction() {
		foreach ($this->arguments as $argument) {
			$argument->getPropertyMappingConfiguration()->forProperty('*')->setTypeConverterOption(	'TYPO3\Flow\Property\TypeConverter\FloatConverter', 'locale', TRUE);
		}
   }


  	public function initializeEditAction() {
    //  $this->arguments['album']->getPropertyMappingConfiguration()->setTypeConverterOption(
      //         'TYPO3\Flow\Property\TypeConverter\FloatConverter', 'locale', TRUE
//       );
   }

	/**
	 * Shows a form for editing an existing album object
	 *
	 * @param \WL\Album\Domain\Model\Album $album
	 * @return void
	 */
	public function editAction(\WL\Album\Domain\Model\Album $album) {

		$this->view->assign('album', $album);
	}


 	/**
	 *
	 *
	 * @param \TYPO3\Media\Domain\Model\Image $image
	 * @return string
	 */
	public function deleteImageAction(\TYPO3\Media\Domain\Model\Image $image) {
  die(\TYPO3\Flow\var_dump($image));
		$this->imageRepository->remove($image);
      return '';
	}



	/**
	 * Inits a form for creating a new detail object
	 *
	 * @return void
	 */
	public function initializeUpdateAction(){

	}



	/**
	 * Updates the given album object
	 *
	 * @param \WL\Album\Domain\Model\Album $album
	 * @Flow\Validate(argumentName="$album.image.0", type="\TYPO3\Media\Validator\ImageTypeValidator", options={ "allowedTypes"={"jpeg", "png","gif"} })
	 * @return void
	 */
	public function updateAction(\WL\Album\Domain\Model\Album $album) {
		//die(\TYPO3\Flow\var_dump($album));

		$this->albumRepository->update($album);
		$this->persistenceManager->persistAll();
		$this->redirect('index');
	}

	/**
	 * Removes the given album object from the album repository
	 *
	 * @param \WL\Album\Domain\Model\Album $album The detail and album to delete
	 * @return void
	 */
	public function deleteAction(Album $album) {
		$this->albumRepository->remove($album);
		$this->addFlashMessage('Deleted a album & detail.');
		$this->redirect('index');
	}


}

?>