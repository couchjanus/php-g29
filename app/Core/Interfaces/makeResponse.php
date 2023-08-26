<?php
namespace Core\Interfaces;

// require_once ROOT.'/app/Core/Response.php';
use Core\Response; 

interface makeResponse {

	/**
	 * Get Response object
	 *
	 * @return Response
	 */
	public function getResponse(string $layout) : Response;
	
}