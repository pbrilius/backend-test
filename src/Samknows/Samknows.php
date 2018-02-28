<?php

namespace Samknows;

const APPLICATION_NAME = 'SamKnows backend technical test';
const APPLICATION_VERSION = '1.0.0';

const METRICS_DOWNLOAD = 'download';
const MEtRICS_UPLOAD = 'upload';
const METRICS_LATENCY = 'latency';
const METRICS_PACKET_LOSS = 'packet_loss';

const INDICATOR_MIN = 'MIN';
const INDICATOR_MAX = 'MAX';
const INDICATOR_MEDIAN = 'MEDIAN';
const INDICATOR_AVG = 'AVG';

const METRICS = [
    \Samknows\METRICS_DOWNLOAD,
    \Samknows\MEtRICS_UPLOAD,
    \Samknows\METRICS_LATENCY,
    \Samknows\METRICS_PACKET_LOSS,
];

const INDICATORS = [
    \Samknows\INDICATOR_MIN,
    \Samknows\INDICATOR_MAX,
    \Samknows\INDICATOR_MEDIAN,
    \Samknows\INDICATOR_AVG,
];

const DOCTRINE_SUPPORTED_INDICATORS = [
    \Samknows\INDICATOR_MIN,
    \Samknows\INDICATOR_MAX,
    \Samknows\INDICATOR_AVG,
];
