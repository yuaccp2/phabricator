<?php

/*
 * Copyright 2012 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

final class PhabricatorObjectItemListView extends AphrontView {

  private $header;
  private $items;
  private $pager;

  public function setHeader($header) {
    $this->header = $header;
    return $this;
  }

  public function setPager($pager) {
    $this->pager = $pager;
    return $this;
  }

  public function addItem(PhabricatorObjectItemView $item) {
    $this->items[] = $item;
    return $this;
  }

  public function render() {
    require_celerity_resource('phabricator-object-item-list-view-css');

    $header = phutil_render_tag(
      'h1',
      array(
        'class' => 'phabricator-object-item-list-header',
      ),
      phutil_escape_html($this->header));
    $items = $this->renderSingleView($this->items);

    $pager = null;
    if ($this->pager) {
      $pager = $this->renderSingleView($this->pager);
    }

    return phutil_render_tag(
      'div',
      array(
        'class' => 'phabricator-object-item-list-view',
      ),
      $header.$items.$pager);
  }

}
