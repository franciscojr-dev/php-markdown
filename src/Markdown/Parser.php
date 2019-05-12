<?php

namespace Markdown;

class Parser
{

  private function __construct() {}

  /**
   * Markdown file
   *
   * @param Markdown $markdown
   * @return string
   */
  static public function markdown(Markdown $markdown)
  {
    return self::syntax($markdown->getContent());
  }

  private function syntax(array $content)
  {
    $string = '';
    foreach($content as $line) {
      $string .= self::replace($line);
    }

    return $string;
  }

  private function replace($string)
  {
    if(preg_match('/^\s+/', $string)) {
      return;
    }

    if(preg_match('/^[^a-zA-Z0-9]+/', $string, $match)) {
      switch($match[0]) {
        case '# ':
          $html = '<h1>%s</h1>';
          break;
        case '## ':
          $html = '<h2>%s</h2>';
          break;
        case '### ':
          $html = '<h3>%s</h3>';
          break;
        case '*':
          $html = '<i>%s</i>';
          break;
        case '**':
          $html = '<b>%s</b>';
          break;
        case '> ':
          $html = '<blockquote><p>%s</p></blockquote>';
          break;
        default:
          $html = '';
      }

      $match = addcslashes($match[0], '*');
    } else {
      $html = '<p>%s</p>';
      $match = '';
    }

    return preg_replace_callback("/^{$match}(.*)/", function($matchs) use ($html, $match) {
      return sprintf($html, preg_replace("/{$match}$/", '', $matchs[1]));
    }, $string);
  }

}