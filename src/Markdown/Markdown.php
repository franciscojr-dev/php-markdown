<?php

namespace Markdown;

class Markdown
{
  /**
   * @var string $file
   */
  private $file = null;

  /**
   * @var string $content
   */
  private $content = null;

  /**
   * Construct
   *
   * @param string @file
   */
  public function __construct(string $file)
  {
    $this->file = $file;
    $this->content = $this->openFile();
  }

  /**
   * Open file
   *
   * @return null|array
   */
  private function openFile()
  {
    if(file_exists($this->file)) {
      return file($this->file);
    }

    throw new \Exception(sprintf("Error file %s not found.", $this->file));   
  }

  public function getContent()
  {
    return $this->content;
  }

}