<?php

class Project extends TableObject
{
	public $requirementId		= 0;
	public $codeId				= 0;
	public $contentId			= 0;
	public $titleId				= 0;

	public $requirementContent	= '';
	public $codeContent			= '';
	public $contentContent		= '';
	public $titleContent		= '';

	public function getFullContents()
	{
		$requirement = new Requirement( $this->requirementId );
		$this->requirementContent = $requirement->content;

		$code = new Code( $this->codeId );
		$this->codeContent = $code->content;

		$content = new Content( $this->contentId );
		$this->contentContent = $content->content;

		$title = new Title( $this->titleId );
		$this->titleContent = $title->content;
	}

	public static function getIdByData( $titleId, $contentId, $codeId, $requirementId )
	{
		global $app;

		$query = "select id from project where
					requirementId = $requirementId and
					codeId = $codeId and
					contentId = $contentId and
					titleId = $titleId
				limit 1";

		if ( $id = (int) $app->db->simpleQuery( $query, true, true ) )
		{
			return $id;
		}
		else
		{
			$query = "insert into project
					(requirementId,
					codeId,
					contentId,
					titleId)
					values
					($requirementId,
					$codeId,
					$contentId,
					$titleId)";

			if ( $id = (int) $app->db->simpleQuery( $query ) )
			{
				return $id;
			}
			else
			{
				throw new Exception( "project: $requirementId, $codeId, $contentId, $titleId query: $query" );
			}
		}
	}
}

