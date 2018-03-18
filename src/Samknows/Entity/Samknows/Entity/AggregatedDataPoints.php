<?php

namespace Samknows\Entity;

/**
 * AggregatedDataPoints
 */
class AggregatedDataPoints
{
    /**
     * @var integer
     */
    private $unitId;

    /**
     * @var integer
     */
    private $hour;

    /**
     * @var integer
     */
    private $downloadMin = '0';

    /**
     * @var integer
     */
    private $downloadMedian = '0';

    /**
     * @var integer
     */
    private $downloadMax = '0';

    /**
     * @var float
     */
    private $downloadAvg = '0.00';

    /**
     * @var integer
     */
    private $uploadMin = '0';

    /**
     * @var integer
     */
    private $uploadMedian = '0';

    /**
     * @var integer
     */
    private $uploadMax = '0';

    /**
     * @var float
     */
    private $uploadAvg = '0.00';

    /**
     * @var integer
     */
    private $latencyMin = '0';

    /**
     * @var integer
     */
    private $latencyMedian = '0';

    /**
     * @var integer
     */
    private $latencyMax = '0';

    /**
     * @var float
     */
    private $latencyAvg = '0.00';

    /**
     * @var float
     */
    private $packetLossMin = '0.00';

    /**
     * @var float
     */
    private $packetLossMedian = '0.00';

    /**
     * @var float
     */
    private $packetLossMax = '0.00';

    /**
     * @var float
     */
    private $packetLossAvg = '0.00';

    /**
     * @var integer
     */
    private $sampleSize = '0';

    /**
     * @var integer
     */
    private $id;


    /**
     * Set unitId
     *
     * @param integer $unitId
     *
     * @return AggregatedDataPoints
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
     * Set hour
     *
     * @param integer $hour
     *
     * @return AggregatedDataPoints
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return integer
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set downloadMin
     *
     * @param integer $downloadMin
     *
     * @return AggregatedDataPoints
     */
    public function setDownloadMin($downloadMin)
    {
        $this->downloadMin = $downloadMin;

        return $this;
    }

    /**
     * Get downloadMin
     *
     * @return integer
     */
    public function getDownloadMin()
    {
        return $this->downloadMin;
    }

    /**
     * Set downloadMedian
     *
     * @param integer $downloadMedian
     *
     * @return AggregatedDataPoints
     */
    public function setDownloadMedian($downloadMedian)
    {
        $this->downloadMedian = $downloadMedian;

        return $this;
    }

    /**
     * Get downloadMedian
     *
     * @return integer
     */
    public function getDownloadMedian()
    {
        return $this->downloadMedian;
    }

    /**
     * Set downloadMax
     *
     * @param integer $downloadMax
     *
     * @return AggregatedDataPoints
     */
    public function setDownloadMax($downloadMax)
    {
        $this->downloadMax = $downloadMax;

        return $this;
    }

    /**
     * Get downloadMax
     *
     * @return integer
     */
    public function getDownloadMax()
    {
        return $this->downloadMax;
    }

    /**
     * Set downloadAvg
     *
     * @param float $downloadAvg
     *
     * @return AggregatedDataPoints
     */
    public function setDownloadAvg($downloadAvg)
    {
        $this->downloadAvg = $downloadAvg;

        return $this;
    }

    /**
     * Get downloadAvg
     *
     * @return float
     */
    public function getDownloadAvg()
    {
        return $this->downloadAvg;
    }

    /**
     * Set uploadMin
     *
     * @param integer $uploadMin
     *
     * @return AggregatedDataPoints
     */
    public function setUploadMin($uploadMin)
    {
        $this->uploadMin = $uploadMin;

        return $this;
    }

    /**
     * Get uploadMin
     *
     * @return integer
     */
    public function getUploadMin()
    {
        return $this->uploadMin;
    }

    /**
     * Set uploadMedian
     *
     * @param integer $uploadMedian
     *
     * @return AggregatedDataPoints
     */
    public function setUploadMedian($uploadMedian)
    {
        $this->uploadMedian = $uploadMedian;

        return $this;
    }

    /**
     * Get uploadMedian
     *
     * @return integer
     */
    public function getUploadMedian()
    {
        return $this->uploadMedian;
    }

    /**
     * Set uploadMax
     *
     * @param integer $uploadMax
     *
     * @return AggregatedDataPoints
     */
    public function setUploadMax($uploadMax)
    {
        $this->uploadMax = $uploadMax;

        return $this;
    }

    /**
     * Get uploadMax
     *
     * @return integer
     */
    public function getUploadMax()
    {
        return $this->uploadMax;
    }

    /**
     * Set uploadAvg
     *
     * @param float $uploadAvg
     *
     * @return AggregatedDataPoints
     */
    public function setUploadAvg($uploadAvg)
    {
        $this->uploadAvg = $uploadAvg;

        return $this;
    }

    /**
     * Get uploadAvg
     *
     * @return float
     */
    public function getUploadAvg()
    {
        return $this->uploadAvg;
    }

    /**
     * Set latencyMin
     *
     * @param integer $latencyMin
     *
     * @return AggregatedDataPoints
     */
    public function setLatencyMin($latencyMin)
    {
        $this->latencyMin = $latencyMin;

        return $this;
    }

    /**
     * Get latencyMin
     *
     * @return integer
     */
    public function getLatencyMin()
    {
        return $this->latencyMin;
    }

    /**
     * Set latencyMedian
     *
     * @param integer $latencyMedian
     *
     * @return AggregatedDataPoints
     */
    public function setLatencyMedian($latencyMedian)
    {
        $this->latencyMedian = $latencyMedian;

        return $this;
    }

    /**
     * Get latencyMedian
     *
     * @return integer
     */
    public function getLatencyMedian()
    {
        return $this->latencyMedian;
    }

    /**
     * Set latencyMax
     *
     * @param integer $latencyMax
     *
     * @return AggregatedDataPoints
     */
    public function setLatencyMax($latencyMax)
    {
        $this->latencyMax = $latencyMax;

        return $this;
    }

    /**
     * Get latencyMax
     *
     * @return integer
     */
    public function getLatencyMax()
    {
        return $this->latencyMax;
    }

    /**
     * Set latencyAvg
     *
     * @param float $latencyAvg
     *
     * @return AggregatedDataPoints
     */
    public function setLatencyAvg($latencyAvg)
    {
        $this->latencyAvg = $latencyAvg;

        return $this;
    }

    /**
     * Get latencyAvg
     *
     * @return float
     */
    public function getLatencyAvg()
    {
        return $this->latencyAvg;
    }

    /**
     * Set packetLossMin
     *
     * @param float $packetLossMin
     *
     * @return AggregatedDataPoints
     */
    public function setPacketLossMin($packetLossMin)
    {
        $this->packetLossMin = $packetLossMin;

        return $this;
    }

    /**
     * Get packetLossMin
     *
     * @return float
     */
    public function getPacketLossMin()
    {
        return $this->packetLossMin;
    }

    /**
     * Set packetLossMedian
     *
     * @param float $packetLossMedian
     *
     * @return AggregatedDataPoints
     */
    public function setPacketLossMedian($packetLossMedian)
    {
        $this->packetLossMedian = $packetLossMedian;

        return $this;
    }

    /**
     * Get packetLossMedian
     *
     * @return float
     */
    public function getPacketLossMedian()
    {
        return $this->packetLossMedian;
    }

    /**
     * Set packetLossMax
     *
     * @param float $packetLossMax
     *
     * @return AggregatedDataPoints
     */
    public function setPacketLossMax($packetLossMax)
    {
        $this->packetLossMax = $packetLossMax;

        return $this;
    }

    /**
     * Get packetLossMax
     *
     * @return float
     */
    public function getPacketLossMax()
    {
        return $this->packetLossMax;
    }

    /**
     * Set packetLossAvg
     *
     * @param float $packetLossAvg
     *
     * @return AggregatedDataPoints
     */
    public function setPacketLossAvg($packetLossAvg)
    {
        $this->packetLossAvg = $packetLossAvg;

        return $this;
    }

    /**
     * Get packetLossAvg
     *
     * @return float
     */
    public function getPacketLossAvg()
    {
        return $this->packetLossAvg;
    }

    /**
     * Set sampleSize
     *
     * @param integer $sampleSize
     *
     * @return AggregatedDataPoints
     */
    public function setSampleSize($sampleSize)
    {
        $this->sampleSize = $sampleSize;

        return $this;
    }

    /**
     * Get sampleSize
     *
     * @return integer
     */
    public function getSampleSize()
    {
        return $this->sampleSize;
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

