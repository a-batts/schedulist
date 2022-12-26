<?php

namespace App\Classes;

use Dusterio\LinkPreview\Client;

/**
 * Get An Image and Title Preview of Link
 */
class LinkPreview {

  private string $link;
  private string $previewImage;
  private string $text;

  public function __construct(string $link) {
    $this->link = $link;
    $this->previewImage = 'id=link-icon-theme';
    $this->text = "Unable to Load Preview";
  }

  /**
   * Static constructor/ factory
   *
   * @param string|null $link
   * @return LinkPreview
   */
  public static function create(?string $link = ""): LinkPreview {
    return new self($link ?? "");
  }

  public function withExisting(string $image, string $text): LinkPreview {
    if ($image == 'style=background-image:url();')
      $this->previewImage = 'id=link-icon-theme';
    else
      $this->previewImage = $image;
    $this->text = $text;
    return $this;
  }

  /**
   * Generate new preview image and text when nonexistant
   * @return $this
   */
  public function withoutExisting(): LinkPreview {
    $this->updatePreview($this->link);
    return $this;
  }

  /**
   * Return error on validation failure
   * @return $this
   */
  public function withError(): LinkPreview {
    $this->previewImage = 'id=link-icon-theme';
    $this->text = 'Invalid URL';
    return $this;
  }

  /**
   * Update preview with new link
   * @param  string $link
   * @return $this
   */
  public function updatePreview(string $link): LinkPreview {
    $this->link = $link;

    if ($this->link == null || $this->link == '') {
      $this->previewImage = 'id=link-icon-theme';
      $this->text = 'Unable to Load Preview';
      return $this;
    }
    if (substr($link, 0, 7) != 'http://' && substr($link, 0, 8) != 'https://' || strlen($link) <= 9 || str_contains($link, ' ')) {
      $this->previewImage = 'id=link-icon-theme';
      $this->text = 'Invalid URL';
      return $this;
    }

    $client = new Client($link);
    $client->getParser('general')->getReader()->config(['connect_timeout' => 2, 'allow_redirects' => ['max' => 5]]);

    try {
      $preview = $client->getPreview('general');
    } catch (\Dusterio\LinkPreview\Exceptions\ConnectionErrorException $e) {
      $this->text = 'Unable to Load Preview';
      return $this;
    }
    $preview = $preview->toArray();

    $this->text = $preview['title'];

    if (@get_headers($preview['cover']) == false) {
      $this->previewImage = 'id=link-icon-theme';
    }
    $this->previewImage = 'style=background-image:url(' . $preview['cover'] . ');';

    return $this;
  }

  public function getLink(): string {
    return $this->link;
  }

  public function getPreview(): string {
    return $this->previewImage;
  }

  public function getText(): string {
    return $this->text;
  }
}
