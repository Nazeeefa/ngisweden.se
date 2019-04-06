<?php
/*
Plugin Name: NGI Custom Content
Plugin URI: https://github.com/NationalGenomicsInfrastructure/ngisweden.se
Description: Plugin to handle administration, submission and display of library prep methods on the NGI website.
Version: 1.0
Author: Phil Ewels
Author URI: http://phil.ewels.co.uk
License: MIT
*/

// Methods post type
require_once('methods_post_type.php');

// Bioinformatics post type
require_once('bioinformatics_post_type.php');

// Add in the taxonomies
require_once('taxonomies/applications.php');
require_once('taxonomies/seqtype.php');
require_once('taxonomies/status.php');
require_once('taxonomies/keywords.php');

// Link methods and bioinformatics
require_once('methods_bioinfo_linking.php');
