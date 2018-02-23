<?php

namespace Samknows\Entity;

/**
 * DataPoint
 */
class DataPoint
{
    /**
     * @var integer
     */
    private $unitId;

    /**
     * @var integer
     */
    private $download;

    /**
     * @var integer
     */
    private $upload;

    /**
     * @var integer
     */
    private $latency;

    /**
     * @var integer
     */
    private $packetLoss;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set unitId
     *
     * @param integer $unitId
     *
     * @return DataPoint
     */
    public function setUnitId($unitId)
    {
        $this->unitId = $unitId;

        return $this;
    }

    /**
     * Get unitId
     *
     * @return integer
     */
    public function getUnitId()
    {
        return $this->unitId;
    }

    /**
     * Set download
     *
     * @param integer $download
     *
     * @return DataPoint
     */
    public function setDownload($download)
    {
        $this->download = $download;

        return $this;
    }

    /**
     * Get download
     *
     * @return integer
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * Set upload
     *
     * @param integer $upload
     *
     * @return DataPoint
     */
    public function setUpload($upload)
    {
        $this->upload = $upload;

        return $this;
    }

    /**
     * Get upload
     *
     * @return integer
     */
    public function getUpload()
    {
        return $this->upload;
    }

    /**
     * Set latency
     *
     * @param integer $latency
     *
     * @return DataPoint
     */
    public function setLatency($latency)
    {
        $this->latency = $latency;

        return $this;
    }

    /**
     * Get latency
     *
     * @return integer
     */
    public function getLatency()
    {
        return $this->latency;
    }

    /**
     * Set packetLoss
     *
     * @param integer $packetLoss
     *
     * @return DataPoint
     */
    public function setPacketLoss($packetLoss)
    {
        $this->packetLoss = $packetLoss;

        return $this;
    }

    /**
     * Get packetLoss
     *
     * @return integer
     */
    public function getPacketLoss()
    {
        return $this->packetLoss;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return DataPoint
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

