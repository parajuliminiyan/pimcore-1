<?php
/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @category   Pimcore
 * @package    Document
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace Pimcore\Model\Document\Tag;

use Pimcore\Model;

/**
 * @method \Pimcore\Model\Document\Tag\Dao getDao()
 */
class Checkbox extends Model\Document\Tag
{
    /**
     * Contains the checkbox value
     *
     * @var bool
     */
    public $value = false;

    /**
     * @see TagInterface::getType
     *
     * @return string
     */
    public function getType()
    {
        return 'checkbox';
    }

    /**
     * @see TagInterface::getData
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->value;
    }

    /**
     * @see TagInterface::frontend
     *
     * @return string
     */
    public function frontend()
    {
        return $this->value;
    }

    /**
     * @see TagInterface::setDataFromResource
     *
     * @param mixed $data
     *
     * @return $this
     */
    public function setDataFromResource($data)
    {
        $this->value = (bool) $data;

        return $this;
    }

    /**
     * @see TagInterface::setDataFromEditmode
     *
     * @param mixed $data
     *
     * @return $this
     */
    public function setDataFromEditmode($data)
    {
        $this->value = (bool) $data;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !$this->value;
    }

    /**
     * @return bool
     */
    public function isChecked()
    {
        return $this->value;
    }

    /**
     * @deprecated
     *
     * @param Model\Webservice\Data\Document\Element $wsElement
     * @param Model\Document\PageSnippet $document
     * @param array $params
     * @param Model\Webservice\IdMapperInterface|null $idMapper
     *
     * @throws \Exception
     *
     */
    public function getFromWebserviceImport($wsElement, $document = null, $params = [], $idMapper = null)
    {
        $data = $this->sanitizeWebserviceData($wsElement->value);
        if ($data->bool === null || is_bool($data)) {
            $this->value = (bool) $data->value;
        } else {
            throw new \Exception('cannot get values from web service import - invalid data');
        }
    }
}
