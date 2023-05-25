/*
MySQL Data Transfer
Source Host: localhost
Source Database: cims_new
Target Host: localhost
Target Database: cims_new
Date: 11-May-23 2:05:06 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for allseziures
-- ----------------------------
CREATE TABLE `allseziures` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT NULL,
  `search_id` varchar(255) DEFAULT NULL,
  `SeziureDate` date DEFAULT NULL,
  `SeizureTime` time DEFAULT NULL,
  `SeizedFromName` varchar(255) DEFAULT NULL,
  `SeizedFromCid` varchar(255) DEFAULT NULL,
  `SeizureDoc` varchar(255) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for assetbanks
-- ----------------------------
CREATE TABLE `assetbanks` (
  `bank_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `suspect` varchar(200) DEFAULT NULL,
  `party_type` varchar(200) DEFAULT '',
  `bank_involvement` varchar(255) DEFAULT '',
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `accountType` varchar(100) DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT 'bank',
  `accountno` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for assetbuildings
-- ----------------------------
CREATE TABLE `assetbuildings` (
  `aBuilding_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `suspect` varchar(200) NOT NULL,
  `party_type` varchar(200) NOT NULL,
  `involvement` varchar(255) NOT NULL,
  `plotNo` varchar(200) DEFAULT NULL,
  `thramNo` varchar(200) DEFAULT NULL,
  `plr` varchar(200) DEFAULT NULL,
  `flatNo` varchar(100) DEFAULT NULL,
  `noOfUnits` varchar(100) DEFAULT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `dzongkhag` varchar(200) DEFAULT NULL,
  `gewog` varchar(200) DEFAULT NULL,
  `village` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT 'building',
  `fileX` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`aBuilding_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for assetlands
-- ----------------------------
CREATE TABLE `assetlands` (
  `aland_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `suspect` varchar(200) DEFAULT NULL,
  `party_type` varchar(200) NOT NULL,
  `involvement` varchar(255) NOT NULL,
  `plotNo` varchar(200) DEFAULT NULL,
  `thramNo` varchar(200) DEFAULT NULL,
  `area` varchar(200) DEFAULT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `dzongkhag` varchar(200) DEFAULT NULL,
  `gewog` varchar(200) DEFAULT NULL,
  `village` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT 'land',
  `fileX` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`aland_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for assetsecurities
-- ----------------------------
CREATE TABLE `assetsecurities` (
  `aSecurities_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no` varchar(200) NOT NULL,
  `suspect` varchar(200) NOT NULL,
  `asset_type` varchar(200) NOT NULL,
  `freezeDate` date NOT NULL,
  `securites_type` varchar(200) NOT NULL,
  `issuer` varchar(200) DEFAULT NULL,
  `no_shares` varchar(200) DEFAULT NULL,
  `purchaseDate` date NOT NULL,
  `bookvalue` varchar(200) DEFAULT NULL,
  `marketvalue` varchar(100) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`aSecurities_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for assettypes
-- ----------------------------
CREATE TABLE `assettypes` (
  `at_id` int(100) NOT NULL AUTO_INCREMENT,
  `asset_Type` varchar(200) NOT NULL,
  PRIMARY KEY (`at_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for assetvehicles
-- ----------------------------
CREATE TABLE `assetvehicles` (
  `avehicle_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `suspect` varchar(200) NOT NULL,
  `party_type` varchar(200) NOT NULL,
  `equipmentType` varchar(200) NOT NULL,
  `involvement` varchar(255) NOT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `registrationNo` varchar(100) DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `expiryDate` date DEFAULT NULL,
  `condition` varchar(200) DEFAULT NULL,
  `validaty` varchar(200) DEFAULT NULL,
  `kilometre` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `vehicleNo` varchar(200) DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT 'Vehicle',
  `fileX` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`avehicle_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for frozenassets
-- ----------------------------
CREATE TABLE `frozenassets` (
  `fa_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT NULL,
  `asset_type` varchar(200) NOT NULL,
  `freezeDate` date NOT NULL,
  `plotNo` varchar(200) DEFAULT NULL,
  `thramNo` varchar(200) DEFAULT NULL,
  `area` varchar(200) DEFAULT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `dzongkhag` varchar(200) DEFAULT NULL,
  `gewog` varchar(200) DEFAULT NULL,
  `village` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `plr` decimal(50,0) DEFAULT NULL,
  `flatNo` varchar(100) DEFAULT NULL,
  `noOfUnits` int(100) DEFAULT NULL,
  `equipmentType` varchar(100) DEFAULT NULL,
  `registrationNo` varchar(100) DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `accountType` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`fa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for mainforensics
-- ----------------------------
CREATE TABLE `mainforensics` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `seizure_id` int(11) DEFAULT NULL,
  `case_no_id` varchar(255) DEFAULT NULL,
  `officername` varchar(255) DEFAULT 'Not Assigned',
  `Instruction` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `serialNo` varchar(255) DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `assignstatus` varchar(255) DEFAULT 'Not Assigned',
  `officerstatus` varchar(255) DEFAULT 'Not Started',
  `officersubstatus` varchar(255) DEFAULT 'Not Started',
  `finalstatus` varchar(255) DEFAULT NULL,
  `completionstatus` varchar(255) DEFAULT NULL,
  `startdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `enddate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for mainseizures
-- ----------------------------
CREATE TABLE `mainseizures` (
  `seizure_id` int(11) NOT NULL,
  `case_no_id` varchar(255) DEFAULT NULL,
  `search_id` varchar(255) DEFAULT NULL,
  `seizure_type` varchar(255) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Updated_at` timestamp NULL DEFAULT NULL,
  `currency_type` varchar(255) DEFAULT NULL,
  `denomination` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `serialNo` varchar(200) DEFAULT NULL,
  `condition` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `item` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `inbox` varchar(200) DEFAULT NULL,
  `sent` varchar(200) DEFAULT NULL,
  `draft` varchar(200) DEFAULT NULL,
  `trash` varchar(200) DEFAULT NULL,
  `spam` varchar(200) DEFAULT '',
  `oldpassword` varchar(200) DEFAULT '',
  `phoneNo` varchar(200) DEFAULT NULL,
  `passport_no` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `issue_date` varchar(200) DEFAULT NULL,
  `expiry_date` varchar(200) DEFAULT NULL,
  `platform` varchar(200) DEFAULT NULL,
  `account_name` varchar(200) DEFAULT NULL,
  `social_password` varchar(200) DEFAULT NULL,
  `sociaL_old_password` varchar(200) DEFAULT NULL,
  `assignstatus` varchar(200) DEFAULT 'Not Assigned',
  `status` varchar(200) DEFAULT 'Seized'
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for seizuretypes
-- ----------------------------
CREATE TABLE `seizuretypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seizure_type` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for seizurewitnesses
-- ----------------------------
CREATE TABLE `seizurewitnesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SeizureId` int(11) DEFAULT NULL,
  `WitnessName` varchar(255) DEFAULT NULL,
  `WitnessCID` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_agencynames_lookup
-- ----------------------------
CREATE TABLE `tbl_agencynames_lookup` (
  `agency_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `agency_name` varchar(150) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`agency_name_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_areas_lookup
-- ----------------------------
CREATE TABLE `tbl_areas_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_branch_lookup
-- ----------------------------
CREATE TABLE `tbl_branch_lookup` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `branch_head` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_action_plans
-- ----------------------------
CREATE TABLE `tbl_case_action_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT '',
  `activity_category` varchar(255) DEFAULT '',
  `cycle` varchar(255) DEFAULT '',
  `actionplanstartdate` date DEFAULT NULL,
  `actionplanenddate` date DEFAULT NULL,
  `weekname` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_actionplan_activities
-- ----------------------------
CREATE TABLE `tbl_case_actionplan_activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `actionplanid` int(10) NOT NULL,
  `task` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`actionplanid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_activities
-- ----------------------------
CREATE TABLE `tbl_case_activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT '',
  `activity` varchar(255) DEFAULT '',
  `task_description` varchar(255) DEFAULT NULL,
  `assigned_to` varchar(255) DEFAULT '',
  `status` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `week` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_assetbanks
-- ----------------------------
CREATE TABLE `tbl_case_assetbanks` (
  `bank_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `suspect` varchar(200) DEFAULT NULL,
  `party_type` varchar(200) DEFAULT '',
  `bank_involvement` varchar(255) DEFAULT '',
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `accountType` varchar(100) DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT 'bank',
  `accountno` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_assetbuildings
-- ----------------------------
CREATE TABLE `tbl_case_assetbuildings` (
  `aBuilding_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `suspect` varchar(200) NOT NULL,
  `party_type` varchar(200) NOT NULL,
  `involvement` varchar(255) NOT NULL,
  `plotNo` varchar(200) DEFAULT NULL,
  `thramNo` varchar(200) DEFAULT NULL,
  `plr` varchar(200) DEFAULT NULL,
  `flatNo` varchar(100) DEFAULT NULL,
  `noOfUnits` varchar(100) DEFAULT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `dzongkhag` varchar(200) DEFAULT NULL,
  `gewog` varchar(200) DEFAULT NULL,
  `village` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT 'building',
  `fileX` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`aBuilding_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_assetlands
-- ----------------------------
CREATE TABLE `tbl_case_assetlands` (
  `aland_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `suspect` varchar(200) DEFAULT NULL,
  `party_type` varchar(200) NOT NULL,
  `involvement` varchar(255) NOT NULL,
  `plotNo` varchar(200) DEFAULT NULL,
  `thramNo` varchar(200) DEFAULT NULL,
  `area` varchar(200) DEFAULT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `dzongkhag` varchar(200) DEFAULT NULL,
  `gewog` varchar(200) DEFAULT NULL,
  `village` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT 'land',
  `fileX` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`aland_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_assetsecurities
-- ----------------------------
CREATE TABLE `tbl_case_assetsecurities` (
  `aSecurities_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no` varchar(200) NOT NULL,
  `suspect` varchar(200) NOT NULL,
  `asset_type` varchar(200) NOT NULL,
  `freezeDate` date NOT NULL,
  `securites_type` varchar(200) NOT NULL,
  `issuer` varchar(200) DEFAULT NULL,
  `no_shares` varchar(200) DEFAULT NULL,
  `purchaseDate` date NOT NULL,
  `bookvalue` varchar(200) DEFAULT NULL,
  `marketvalue` varchar(100) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`aSecurities_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_assettypes
-- ----------------------------
CREATE TABLE `tbl_case_assettypes` (
  `at_id` int(100) NOT NULL AUTO_INCREMENT,
  `asset_Type` varchar(200) NOT NULL,
  PRIMARY KEY (`at_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_assetvehicles
-- ----------------------------
CREATE TABLE `tbl_case_assetvehicles` (
  `avehicle_id` int(255) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `suspect` varchar(200) NOT NULL,
  `party_type` varchar(200) NOT NULL,
  `equipmentType` varchar(200) NOT NULL,
  `involvement` varchar(255) NOT NULL,
  `owner` varchar(200) DEFAULT NULL,
  `ownerCID` varchar(200) DEFAULT NULL,
  `ownerName` varchar(200) DEFAULT NULL,
  `registrationNo` varchar(100) DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `expiryDate` date DEFAULT NULL,
  `condition` varchar(200) DEFAULT NULL,
  `validaty` varchar(200) DEFAULT NULL,
  `kilometre` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `vehicleNo` varchar(200) DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT 'Vehicle',
  `fileX` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`avehicle_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_conflicts
-- ----------------------------
CREATE TABLE `tbl_case_conflicts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_no_id` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `declared_by` varchar(255) DEFAULT NULL,
  `nature_of_conflict` varchar(255) DEFAULT NULL,
  `conflict_status` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_detentions
-- ----------------------------
CREATE TABLE `tbl_case_detentions` (
  `d_id` int(200) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) DEFAULT NULL,
  `arrest_id` varchar(200) DEFAULT NULL,
  `detained_from` varchar(200) DEFAULT NULL,
  `detained_on` date DEFAULT NULL,
  `detained_time` time DEFAULT NULL,
  `detained_location` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_entities
-- ----------------------------
CREATE TABLE `tbl_case_entities` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `case_no_id` int(20) NOT NULL,
  `identification_no` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dateofbirth` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `dzongkhag` varchar(255) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `gewog` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contactno` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `permanentaddress` varchar(2000) DEFAULT NULL,
  `entitytype` varchar(200) DEFAULT NULL,
  `involvement` varchar(200) DEFAULT NULL,
  `photopath` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_events
-- ----------------------------
CREATE TABLE `tbl_case_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT '',
  `category` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `conducted_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_evidences
-- ----------------------------
CREATE TABLE `tbl_case_evidences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT '',
  `evidence_subcategory` varchar(255) DEFAULT '',
  `evidence_category` varchar(255) DEFAULT NULL,
  `collected_on` date DEFAULT NULL,
  `collected_by` varchar(255) DEFAULT NULL,
  `evidence_description` varchar(255) DEFAULT NULL,
  `evidence_no` varchar(255) DEFAULT NULL,
  `collected_from` varchar(255) DEFAULT '',
  `evidence_file_path` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `evidence_name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_factstodetermine
-- ----------------------------
CREATE TABLE `tbl_case_factstodetermine` (
  `int` int(20) NOT NULL AUTO_INCREMENT,
  `interviewplanid` int(20) DEFAULT NULL,
  `pointstoprove` varchar(2000) DEFAULT NULL,
  `factstodetermine` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`int`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_hypotheses
-- ----------------------------
CREATE TABLE `tbl_case_hypotheses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` int(222) DEFAULT NULL,
  `hypotheses` varchar(255) DEFAULT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  `evaluation_status` varchar(255) DEFAULT NULL,
  `evaluated_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_hypothesis
-- ----------------------------
CREATE TABLE `tbl_case_hypothesis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` int(222) DEFAULT NULL,
  `hypotheses` varchar(255) DEFAULT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  `evaluation_status` varchar(255) DEFAULT NULL,
  `evaluated_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_interviewers
-- ----------------------------
CREATE TABLE `tbl_case_interviewers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_no_id` int(11) NOT NULL,
  `interviewers` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_interviewplans
-- ----------------------------
CREATE TABLE `tbl_case_interviewplans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT '',
  `accused` varchar(255) NOT NULL,
  `interview_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `defences` varchar(2000) NOT NULL,
  `facts_established` varchar(225) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_investigation_plans
-- ----------------------------
CREATE TABLE `tbl_case_investigation_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` int(255) DEFAULT NULL,
  `case_background` varchar(255) DEFAULT NULL,
  `allegations` varchar(255) DEFAULT NULL,
  `objectives` varchar(255) DEFAULT NULL,
  `scope` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `case_end_date` date DEFAULT NULL,
  `case_start_date` date DEFAULT NULL,
  `startdate_actionplan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_mainarrests
-- ----------------------------
CREATE TABLE `tbl_case_mainarrests` (
  `arrest_id` int(200) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(200) NOT NULL,
  `typeofArrest` varchar(200) DEFAULT NULL,
  `suspect` int(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `pcause` varchar(200) DEFAULT NULL,
  `applicationdate` date DEFAULT NULL,
  `arrest_requested_by` varchar(255) DEFAULT NULL,
  `commissionStatus` varchar(200) DEFAULT '0',
  `commissionReview` varchar(200) DEFAULT NULL,
  `remandStatus` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`arrest_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_mainsearches
-- ----------------------------
CREATE TABLE `tbl_case_mainsearches` (
  `search_id` int(200) NOT NULL AUTO_INCREMENT,
  `seizureStatus` varchar(255) DEFAULT 'Not Seized',
  `case_no_id` varchar(200) NOT NULL,
  `typeofsearch` varchar(200) DEFAULT NULL,
  `suspect` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `searchtarget` varchar(200) DEFAULT '',
  `pcause` varchar(200) DEFAULT NULL,
  `applicationdate` date DEFAULT NULL,
  `commissionStatus` varchar(200) DEFAULT '0',
  `commissionReview` varchar(200) DEFAULT NULL,
  `warrantNo` varchar(200) DEFAULT NULL,
  `warrantDate` date DEFAULT NULL,
  `warrantRemark` varchar(200) DEFAULT NULL,
  `fileY` varchar(200) DEFAULT NULL,
  `fileX` varchar(200) DEFAULT NULL,
  `identification_no` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `public_premise_name` varchar(255) DEFAULT NULL,
  `public_premise_location` varchar(255) DEFAULT NULL,
  `private_premise_location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_case_offences
-- ----------------------------
CREATE TABLE `tbl_case_offences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_no_id` int(11) DEFAULT NULL,
  `offence_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_offencetypesinvplan
-- ----------------------------
CREATE TABLE `tbl_case_offencetypesinvplan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` int(255) DEFAULT NULL,
  `offence_type` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_case_organization
-- ----------------------------
CREATE TABLE `tbl_case_organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_no_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_organizations
-- ----------------------------
CREATE TABLE `tbl_case_organizations` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `case_no_id` int(20) NOT NULL,
  `business_license_no` varchar(255) DEFAULT NULL,
  `business_location` varchar(255) DEFAULT NULL,
  `business_owner` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT '',
  `business_license_issue_date` varchar(255) DEFAULT NULL,
  `business_license_expiry_date` varchar(255) DEFAULT NULL,
  `business_activity` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT '',
  `phone_no` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `parent_agency` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_summon_documents
-- ----------------------------
CREATE TABLE `tbl_case_summon_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `summon_id` int(11) NOT NULL,
  `document_name` varchar(500) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_summonorders
-- ----------------------------
CREATE TABLE `tbl_case_summonorders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interviewplan_id` int(11) DEFAULT NULL,
  `case_no_id` int(11) DEFAULT NULL,
  `interviewee` varchar(255) DEFAULT NULL,
  `report_to` varchar(255) DEFAULT NULL,
  `summondate` date DEFAULT NULL,
  `summontime` time DEFAULT NULL,
  `summonvenue` varchar(255) DEFAULT NULL,
  `summonorderstatus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_case_suspensions
-- ----------------------------
CREATE TABLE `tbl_case_suspensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT '',
  `suspension_type` varchar(255) DEFAULT '',
  `license_no` varchar(255) DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `revoke_date` date DEFAULT NULL,
  `suspension_status` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_collection_methods_lookup
-- ----------------------------
CREATE TABLE `tbl_collection_methods_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_complaints
-- ----------------------------
CREATE TABLE `tbl_complaints` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `complaint_no` varchar(255) DEFAULT '',
  `complaint_title` varchar(255) DEFAULT '',
  `complaint_status` varchar(255) DEFAULT '',
  `case_substatus` varchar(255) DEFAULT NULL,
  `complaint_reg_date` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_courts_lookup
-- ----------------------------
CREATE TABLE `tbl_courts_lookup` (
  `court_id` int(11) NOT NULL AUTO_INCREMENT,
  `court_type` varchar(200) NOT NULL,
  PRIMARY KEY (`court_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_entities
-- ----------------------------
CREATE TABLE `tbl_entities` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `identification_no` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dateofbirth` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `dzongkhag` varchar(255) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `gewog` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contactno` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `permanentaddress` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_idiary_details
-- ----------------------------
CREATE TABLE `tbl_idiary_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_no_id` varchar(255) DEFAULT '',
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Ongoing',
  `assigned_to` varchar(255) DEFAULT NULL,
  `task_to_be_done` varchar(255) DEFAULT '',
  `remarks` varchar(255) DEFAULT NULL,
  `activity_category` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_institutiontypes_lookup
-- ----------------------------
CREATE TABLE `tbl_institutiontypes_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_interviewtypes_lookup
-- ----------------------------
CREATE TABLE `tbl_interviewtypes_lookup` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `interview_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_investigationtype_lookup
-- ----------------------------
CREATE TABLE `tbl_investigationtype_lookup` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_offences_lookup
-- ----------------------------
CREATE TABLE `tbl_offences_lookup` (
  `offence_id` int(11) NOT NULL AUTO_INCREMENT,
  `offence_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`offence_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_parentagencies_lookup
-- ----------------------------
CREATE TABLE `tbl_parentagencies_lookup` (
  `parent_agency_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_agency` varchar(150) NOT NULL,
  PRIMARY KEY (`parent_agency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_partytypes_lookup
-- ----------------------------
CREATE TABLE `tbl_partytypes_lookup` (
  `party_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `party_type` varchar(150) NOT NULL,
  PRIMARY KEY (`party_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_priorities_lookup
-- ----------------------------
CREATE TABLE `tbl_priorities_lookup` (
  `priority_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority_type` varchar(255) DEFAULT NULL,
  `active_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`priority_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_recommendationstatuses_lookup
-- ----------------------------
CREATE TABLE `tbl_recommendationstatuses_lookup` (
  `recommendationstatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `recommendationstatus_type` varchar(200) NOT NULL,
  PRIMARY KEY (`recommendationstatus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Table structure for tbl_registered_cases
-- ----------------------------
CREATE TABLE `tbl_registered_cases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_no` varchar(2000) NOT NULL,
  `case_title` varchar(2000) NOT NULL,
  `source_type` varchar(255) DEFAULT '',
  `sector` varchar(255) DEFAULT NULL,
  `sector_type` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `institution_type` varchar(255) DEFAULT NULL,
  `allegation_details` varchar(2000) DEFAULT '',
  `instructions` varchar(2000) DEFAULT '',
  `priority` varchar(255) DEFAULT NULL,
  `investigation_type` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `agency_name` varchar(255) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `expected_end_date` date DEFAULT NULL,
  `reassignment_reason` varchar(2000) DEFAULT '',
  `status` varchar(255) DEFAULT NULL,
  `sub_status` varchar(255) DEFAULT NULL,
  `assigned_status` varchar(255) DEFAULT NULL,
  `assignment_order_date` date DEFAULT NULL,
  `case_summary` varchar(2000) DEFAULT NULL,
  `reassignmentstatus` int(11) DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_sectorsubtypes_lookup
-- ----------------------------
CREATE TABLE `tbl_sectorsubtypes_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_sectortypes_lookup
-- ----------------------------
CREATE TABLE `tbl_sectortypes_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_seizuretypes_lookup
-- ----------------------------
CREATE TABLE `tbl_seizuretypes_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seizure_type` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_sources_lookup
-- ----------------------------
CREATE TABLE `tbl_sources_lookup` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `source_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for tbl_task_types_lookup
-- ----------------------------
CREATE TABLE `tbl_task_types_lookup` (
  `id` bigint(20) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_user_role_mapping
-- ----------------------------
CREATE TABLE `tbl_user_role_mapping` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `assigned_by` varchar(200) DEFAULT NULL,
  `assigned_to` varchar(200) DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL,
  `assigned_on` varchar(200) DEFAULT NULL,
  `case_no_id` int(11) NOT NULL,
  `conflictstatus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for users
-- ----------------------------
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT 0,
  `accept_status` varchar(255) DEFAULT 'Not Accepted',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `agency_name` varchar(255) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `expected_role` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `allseziures` VALUES ('55', '43', '45', '2023-03-13', '12:12:00', 'yu', '1234', '', '2023-03-13 06:13:07', null);
INSERT INTO `allseziures` VALUES ('56', '43', '45', '2023-03-13', '12:12:00', 'yu', '1234', '', '2023-03-13 06:13:44', null);
INSERT INTO `allseziures` VALUES ('57', '43', '45', '2023-03-13', '12:12:00', 'yu', '1234', '', '2023-03-13 06:14:13', null);
INSERT INTO `allseziures` VALUES ('58', '43', '45', '2023-03-13', '12:12:00', 'yu', '1234', '', '2023-03-13 06:14:34', null);
INSERT INTO `allseziures` VALUES ('59', '43', '45', '2023-03-13', '12:12:00', 'yu', '1234', '', '2023-03-13 06:15:17', null);
INSERT INTO `allseziures` VALUES ('60', '43', '45', '2023-03-13', '12:17:00', 'hh', '1234', '', '2023-03-13 06:18:12', null);
INSERT INTO `allseziures` VALUES ('54', '43', '45', '2023-03-13', '12:03:00', 'hh', '1234', '', '2023-03-13 06:05:51', null);
INSERT INTO `allseziures` VALUES ('53', null, '42', '2023-03-09', '12:59:00', 'hh', '12345kjh', '', '2023-03-09 08:57:10', null);
INSERT INTO `allseziures` VALUES ('61', '3', '2', '2023-05-09', '12:34:00', 'hh', '34', null, '2023-05-09 06:37:32', null);
INSERT INTO `allseziures` VALUES ('62', '3', '2', '2023-05-09', '12:34:00', 'hh', '34', null, '2023-05-09 06:38:29', null);
INSERT INTO `allseziures` VALUES ('63', '3', '2', '2023-05-09', '12:34:00', 'hh', '34', null, '2023-05-09 06:38:56', null);
INSERT INTO `allseziures` VALUES ('64', '3', '2', '2023-05-09', '12:34:00', 'hh', '34', null, '2023-05-09 06:40:11', null);
INSERT INTO `allseziures` VALUES ('65', '3', '2', '2023-05-09', '12:34:00', 'hh', '34', null, '2023-05-09 06:43:10', null);
INSERT INTO `allseziures` VALUES ('66', '3', '2', '2023-05-09', '12:34:00', 'hh', '34', null, '2023-05-09 06:44:01', null);
INSERT INTO `allseziures` VALUES ('67', '3', '2', '2023-05-09', '12:34:00', 'hh', '34', null, '2023-05-09 06:44:25', null);
INSERT INTO `allseziures` VALUES ('68', '3', '2', '2023-05-09', '11:58:00', 'hh', '12345kjh', null, '2023-05-09 06:45:34', null);
INSERT INTO `allseziures` VALUES ('69', '3', '2', '2023-05-09', '11:58:00', 'hh', '12345kjh', null, '2023-05-09 06:46:29', null);
INSERT INTO `allseziures` VALUES ('70', '3', '3', null, null, null, null, null, '2023-05-11 04:56:20', null);
INSERT INTO `mainforensics` VALUES ('4', null, '43', 'ff@gmail.com', 'cc', '2023-03-13', 'Computer', 'bbnn', 'kk', 'jbj', 'ggff', 'Assigned', 'Processing', 'Imaging', null, 'Successful', '2023-03-14 00:00:00', '2023-03-21 00:00:00', '2023-03-14 15:40:34', null);
INSERT INTO `mainforensics` VALUES ('6', null, null, 'Not Assigned', null, null, '3', '4', 'nn', 'gg', 'jj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-09 12:47:16', null);
INSERT INTO `mainforensics` VALUES ('7', null, null, 'Not Assigned', null, null, '3', '4', 'nn', 'gg', 'jj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-09 12:47:16', null);
INSERT INTO `mainforensics` VALUES ('8', null, null, 'Not Assigned', null, null, 'Computer', 'bbnn', 'nnii', 'kkgg', 'jgj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-09 12:47:16', null);
INSERT INTO `mainforensics` VALUES ('9', null, null, 'Not Assigned', null, null, '3', '4', 'nn', 'gg', 'jj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-10 15:23:54', null);
INSERT INTO `mainforensics` VALUES ('10', null, null, 'Not Assigned', null, null, '3', '4', 'nn', 'gg', 'jj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-10 15:23:54', null);
INSERT INTO `mainforensics` VALUES ('11', null, null, 'Not Assigned', null, null, 'Computer', 'bbnn', 'nnii', 'kkgg', 'jgj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-10 15:23:54', null);
INSERT INTO `mainforensics` VALUES ('12', null, null, 'Not Assigned', null, null, '3', '4', 'nn', 'gg', 'jj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-11 10:56:55', null);
INSERT INTO `mainforensics` VALUES ('13', null, null, 'Not Assigned', null, null, '3', '4', 'nn', 'gg', 'jj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-11 10:56:55', null);
INSERT INTO `mainforensics` VALUES ('14', null, null, 'Not Assigned', null, null, 'Computer', 'bbnn', 'nnii', 'kkgg', 'jgj', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-11 10:56:55', null);
INSERT INTO `mainforensics` VALUES ('15', null, null, 'Not Assigned', null, null, 'Computer', 'bbnn', 'nn', '123', 'good', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-11 10:56:55', null);
INSERT INTO `mainforensics` VALUES ('16', null, null, 'Not Assigned', null, null, '3', 'ert', 'jhj', '56', 'good', 'Not Assigned', 'Not Started', 'Not Started', null, null, null, null, '2023-05-11 10:56:55', null);
INSERT INTO `mainseizures` VALUES ('2', '3', '2', 'Digital Items', '2023-05-09 12:46:45', null, null, null, null, null, '4', 'nn', 'gg', 'jj', null, '3', null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, 'Not Assigned', 'Sent to Forensics');
INSERT INTO `mainseizures` VALUES ('2', '3', '2', 'Digital Items', '2023-05-09 12:46:45', null, null, null, null, null, '4', 'nn', 'gg', 'jj', null, '3', null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, 'Not Assigned', 'Sent to Forensics');
INSERT INTO `mainseizures` VALUES ('2', '3', '2', 'Digital Items', '2023-05-09 12:46:45', null, null, null, null, null, 'bbnn', 'nnii', 'kkgg', 'jgj', null, 'Computer', null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, 'Not Assigned', 'Sent to Forensics');
INSERT INTO `mainseizures` VALUES ('3', '3', '3', 'Digital Items', '2023-05-11 10:56:55', null, null, null, null, null, 'bbnn', 'nn', '123', 'good', null, 'Computer', null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, 'Not Assigned', 'Sent to Forensics');
INSERT INTO `mainseizures` VALUES ('3', '3', '3', 'Digital Items', '2023-05-11 10:56:55', null, null, null, null, null, 'ert', 'jhj', '56', 'good', null, '3', null, null, null, null, null, null, '', '', null, null, null, null, null, null, null, null, null, 'Not Assigned', 'Sent to Forensics');
INSERT INTO `mainseizures` VALUES ('3', '3', '3', 'Emails', '2023-05-11 10:56:55', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'Not Assigned', 'Sent to Forensics');
INSERT INTO `seizuretypes` VALUES ('1', 'Digital Items');
INSERT INTO `seizuretypes` VALUES ('2', 'Emails');
INSERT INTO `seizuretypes` VALUES ('3', 'Social Media');
INSERT INTO `seizuretypes` VALUES ('4', 'Passport');
INSERT INTO `seizuretypes` VALUES ('5', 'Currency');
INSERT INTO `seizurewitnesses` VALUES ('3', '39', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('4', '40', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('5', '41', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('6', '42', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('7', '43', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('8', '44', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('9', '45', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('10', '46', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('11', '47', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('12', '48', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('13', '49', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('14', '50', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('15', '51', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('16', '42', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('17', '42', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('18', '45', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('19', '45', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('20', '45', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('21', '45', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('22', '45', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('23', '45', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('24', '45', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('25', '2', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('26', '2', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('27', '2', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('28', '2', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('29', '2', 'gg', 'gg');
INSERT INTO `seizurewitnesses` VALUES ('30', '2', null, 'gg');
INSERT INTO `seizurewitnesses` VALUES ('31', '2', null, 'gg');
INSERT INTO `seizurewitnesses` VALUES ('32', '3', null, null);
INSERT INTO `tbl_agencynames_lookup` VALUES ('5', 'agency one', null, null);
INSERT INTO `tbl_agencynames_lookup` VALUES ('6', 'agency two', null, null);
INSERT INTO `tbl_agencynames_lookup` VALUES ('7', 'agency three', null, null);
INSERT INTO `tbl_areas_lookup` VALUES ('1', 'Procurement of Goods & Service ');
INSERT INTO `tbl_areas_lookup` VALUES ('2', 'Construction');
INSERT INTO `tbl_areas_lookup` VALUES ('3', 'Recruitment, training, transfer, promotion');
INSERT INTO `tbl_areas_lookup` VALUES ('4', 'Public Expenditure');
INSERT INTO `tbl_areas_lookup` VALUES ('5', 'Taxes and Revenue Administration');
INSERT INTO `tbl_areas_lookup` VALUES ('6', 'Licensing, lease and permits');
INSERT INTO `tbl_areas_lookup` VALUES ('7', 'Customs and immigration services');
INSERT INTO `tbl_areas_lookup` VALUES ('8', 'Banking Services');
INSERT INTO `tbl_areas_lookup` VALUES ('9', 'Land surveying,registration and transfer');
INSERT INTO `tbl_areas_lookup` VALUES ('10', 'Housing allotment');
INSERT INTO `tbl_areas_lookup` VALUES ('11', 'Monitoring and inspection');
INSERT INTO `tbl_areas_lookup` VALUES ('12', 'Traffic Control');
INSERT INTO `tbl_areas_lookup` VALUES ('13', 'Judicial Services');
INSERT INTO `tbl_areas_lookup` VALUES ('14', 'General Administration');
INSERT INTO `tbl_areas_lookup` VALUES ('15', 'Medical Services');
INSERT INTO `tbl_areas_lookup` VALUES ('16', 'Policy and Regulations');
INSERT INTO `tbl_areas_lookup` VALUES ('17', 'Insurance');
INSERT INTO `tbl_areas_lookup` VALUES ('18', 'Manufacturing');
INSERT INTO `tbl_areas_lookup` VALUES ('19', 'Delivery programme and services');
INSERT INTO `tbl_areas_lookup` VALUES ('20', 'Electoral Services');
INSERT INTO `tbl_branch_lookup` VALUES ('1', 'Thimphu-branch I', null, null, 'Tshewang Pem');
INSERT INTO `tbl_branch_lookup` VALUES ('2', 'Thimphu-branch II', null, null, 'Namgay Wangchuk');
INSERT INTO `tbl_branch_lookup` VALUES ('3', 'Phuentsholing field office', null, null, 'Tashi Dema');
INSERT INTO `tbl_branch_lookup` VALUES ('4', 'Bumthang regional office', null, null, 'Garab Dorji');
INSERT INTO `tbl_case_action_plans` VALUES ('22', '3', 'Interview', 'Weekly', '2023-06-14', '2023-06-21', '1', null, null, null, null, 'Open');
INSERT INTO `tbl_case_action_plans` VALUES ('23', '3', 'Interview', 'Weekly', '2023-06-21', '2023-06-28', '2', null, null, null, null, 'Open');
INSERT INTO `tbl_case_actionplan_activities` VALUES ('22', '22', 'test', 'iii', 'High', 'investigator@gmail.com', 'Complete');
INSERT INTO `tbl_case_actionplan_activities` VALUES ('23', '22', 'gg', 'eee', 'Low', 'jk@gmail.com', null);
INSERT INTO `tbl_case_actionplan_activities` VALUES ('24', '23', 'ddd', 'ddgsdg', 'Medium', 'investigator@gmail.com', null);
INSERT INTO `tbl_case_conflicts` VALUES ('4', '1', 'Gyeltshen', 'director@gmail.com', 'Director', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('5', '1', 'Dorji Tenzin', 'chief@gmail.com', 'Chief', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('6', '1', 'Anju', 'anju@gmail.com', 'Investigator', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('7', '1', 'Garab Dorji-investigator', 'investigator@gmail.com', 'Investigator', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('8', '1', 'Dema', 'jk@gmail.com', 'Investigator', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('9', '2', 'Gyeltshen', 'director@gmail.com', 'Director', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('10', '2', 'Dorji Tenzin', 'chief@gmail.com', 'Chief', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('11', '2', 'Dorji Tenzin', 'chief@gmail.com', 'Chief', 'chief confliccr', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('12', '2', 'Garab Dorji-investigator', 'investigator@gmail.com', 'Investigator', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('13', '2', 'Anju', 'anju@gmail.com', 'Investigator', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('14', '2', 'Dema', 'jk@gmail.com', 'Investigator', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('15', '3', 'Gyeltshen', 'director@gmail.com', 'Director', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('16', '3', 'Karma', 'xyz@gmail.com', 'Chief', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('17', '3', 'Garab Dorji-investigator', 'investigator@gmail.com', 'Investigator', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_conflicts` VALUES ('18', '3', 'Anju', 'anju@gmail.com', 'Investigator', 'No Conflict', '1', null, null);
INSERT INTO `tbl_case_detentions` VALUES ('1', null, null, null, null, null, null, null);
INSERT INTO `tbl_case_detentions` VALUES ('2', null, null, null, null, null, null, null);
INSERT INTO `tbl_case_detentions` VALUES ('3', '3', '1', null, null, null, null, null);
INSERT INTO `tbl_case_detentions` VALUES ('4', null, null, null, null, null, null, null);
INSERT INTO `tbl_case_detentions` VALUES ('5', '3', '3', null, null, null, null, null);
INSERT INTO `tbl_case_detentions` VALUES ('6', '3', '4', null, null, null, null, null);
INSERT INTO `tbl_case_entities` VALUES ('15', '3', '11316000287', 'Sarada  Acharya', '15/10/1986', 'Female', 'Bhutanese', 'Sarpang', 'Gelephu Throm', 'Rabdeyling', null, null, null, null, 'Accused', null, 'lion.png');
INSERT INTO `tbl_case_entities` VALUES ('16', '3', '11216003413', 'Preya  Sharma', '14/01/2004', 'Female', 'Bhutanese', 'Samtse', 'Tendu', 'Kuchengang(Kuchin Pakha)', null, null, null, null, 'Accused', null, 'calendar.png');
INSERT INTO `tbl_case_events` VALUES ('1', '3', 'Search and Seizure', 'Test', '2023-05-04', 'Event Desc', 'Garab Dorji-investigator', '2023-05-04 05:06:38', null);
INSERT INTO `tbl_case_events` VALUES ('2', '3', 'Arrest and Detention', 'ggggh', '2023-05-04', 'jhkhjk kjh kjh k', 'Garab Dorji-investigator', '2023-05-04 05:07:40', null);
INSERT INTO `tbl_case_events` VALUES ('3', '3', 'Search and Seizure', 'iuiuiu', '2023-05-04', 'nbjhj', 'Garab Dorji-investigator', '2023-05-04 05:07:55', null);
INSERT INTO `tbl_case_events` VALUES ('4', '3', 'Search and Seizure', 'yyy', '2023-05-11', 'dd', 'Garab Dorji-investigator', '2023-05-11 05:56:20', null);
INSERT INTO `tbl_case_evidences` VALUES ('1', null, null, null, null, 'Garab Dorji-investigator', null, null, null, '', '2023-05-05 05:09:16', null, null);
INSERT INTO `tbl_case_hypothesis` VALUES ('1', '3', 'mm', 'jj', null, null, null, null);
INSERT INTO `tbl_case_hypothesis` VALUES ('2', '3', 'mm', 'kk', null, null, null, null);
INSERT INTO `tbl_case_interviewers` VALUES ('1', '3', 'anju@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('2', '3', 'jk@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('3', '3', 'investigator@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('4', '3', 'jk@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('5', '3', 'investigator@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('6', '3', 'jk@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('7', '3', 'cc@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('8', '3', 'jk@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('9', '3', 'investigator@gmail.com');
INSERT INTO `tbl_case_interviewers` VALUES ('10', '3', 'jk@gmail.com');
INSERT INTO `tbl_case_interviewplans` VALUES ('39', '3', '11316000287', '2023-05-09', 'Thimphu', 'yyyy', 'hhhhhhhhh', '4', null, null);
INSERT INTO `tbl_case_interviewplans` VALUES ('40', '3', '11316000287', '2023-05-10', 'Thimphu', 'sdsf', 'sdf', '4', null, null);
INSERT INTO `tbl_case_interviewplans` VALUES ('41', '3', '11316000287', '2023-05-11', 'Thimphu', 'laksjd fal', 'laskjdf laksdjf lskjd fa', '4', null, null);
INSERT INTO `tbl_case_investigation_plans` VALUES ('1', '3', null, 'mn,m', 'kj', ',mn', null, '2023-06-02', '2023-05-03', '2023-06-28', null, null);
INSERT INTO `tbl_case_mainarrests` VALUES ('1', '3', 'With Court Warrant', '11', 'thimphu', 'jskjf skjf slkfjsl f', '2023-05-09', 'Garab Dorji-investigator', 'Detained', 'ff', '0');
INSERT INTO `tbl_case_mainarrests` VALUES ('2', '3', 'With Court Warrant', '15', 'thimphu', 'ksjfk kajdsf aksjd flaksj flaks jdf', '2023-05-10', 'Garab Dorji-investigator', '0', null, '0');
INSERT INTO `tbl_case_mainarrests` VALUES ('3', '3', 'Without Court Warrant', '16', 'Thimphu', 'kkaldkfj alksjd flakjf alkjfd', '2023-12-31', 'Garab Dorji-investigator', 'Detained', 'fff ff ee', '0');
INSERT INTO `tbl_case_mainarrests` VALUES ('4', '3', 'With Court Warrant', '15', 'Thimphu', 'lakjd flakjf alkdjf alkd falkdjf alk', '2023-05-11', 'Garab Dorji-investigator', 'Detained', 'test', '0');
INSERT INTO `tbl_case_mainsearches` VALUES ('1', 'Not Seized', '', null, null, null, '', null, null, '0', null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `tbl_case_mainsearches` VALUES ('2', 'Seized', '3', 'With Court Warrant', '12', null, '', 'ghj', '2023-05-09', 'Approved', 'dd', null, null, null, null, null, null, null, null, null, 'eeeeeeeeeeee');
INSERT INTO `tbl_case_mainsearches` VALUES ('3', 'Seized', '3', 'With Court Warrant', '16', null, '', 'mmm khjkjh k', '2023-05-11', 'Approved', 'dddd', null, null, null, null, null, null, null, null, null, 'kjhk');
INSERT INTO `tbl_case_mainsearches` VALUES ('4', 'Not Seized', '3', 'With Court Warrant', '15', null, '', 'ss', '2023-05-11', 'Approved', 'ss', null, null, null, null, null, '5678', 'ghgjhg', null, null, null);
INSERT INTO `tbl_case_offences` VALUES ('3', '1', 'ACAB 2011 Sec-47 Passive Bribery IN Relation TO Auctions');
INSERT INTO `tbl_case_offences` VALUES ('4', '1', 'ACAB 2011 Sec-73 Concealment OF Corruption Proceeds');
INSERT INTO `tbl_case_offences` VALUES ('5', '2', 'ACAB 2011 Sec-46 ACTIVE Bribery IN Relation TO Auctions');
INSERT INTO `tbl_case_offences` VALUES ('6', '2', 'ACAB 2011 Sec-68 Embezzlement OF Fund OR Securities IN The Private Sector');
INSERT INTO `tbl_case_offences` VALUES ('7', '3', 'ACAB 2011 Sec-45 Passive Bribery OF FOREIGN Public Servant');
INSERT INTO `tbl_case_offences` VALUES ('8', '3', 'ACAB 2011 Sec-57 Passive Trading IN Influence Involving Public Servant');
INSERT INTO `tbl_case_offencetypesinvplan` VALUES ('1', '3', 'ACAB 2011 Sec-44 ACTIVE Bribery OF FOREIGN Public Servant', null, null, null);
INSERT INTO `tbl_case_summonorders` VALUES ('1', null, '3', 'test', 'investigator@gmail.com', '2023-12-31', '12:59:00', 'kjhkjh', null);
INSERT INTO `tbl_case_summonorders` VALUES ('2', null, '3', 'jigme', 'investigator@gmail.com', '2021-10-31', '00:59:00', 'fghj', null);
INSERT INTO `tbl_collection_methods_lookup` VALUES ('1', 'Interview');
INSERT INTO `tbl_collection_methods_lookup` VALUES ('2', 'Section 94');
INSERT INTO `tbl_collection_methods_lookup` VALUES ('3', 'Search and Seizure');
INSERT INTO `tbl_collection_methods_lookup` VALUES ('4', 'Site Inspection');
INSERT INTO `tbl_complaints` VALUES ('1', 'abc', 'test', '0', null, '2022-12-26', null, '2023-04-26');
INSERT INTO `tbl_complaints` VALUES ('2', 'xyz', 'rrr', 'Registered as case', null, '2021-02-22', null, '2023-04-26');
INSERT INTO `tbl_courts_lookup` VALUES ('1', 'Court One');
INSERT INTO `tbl_courts_lookup` VALUES ('2', 'Court Two');
INSERT INTO `tbl_courts_lookup` VALUES ('3', 'Court Three');
INSERT INTO `tbl_entities` VALUES ('2', '11316000287', 'Sarada  Acharya', '15/10/1986', 'Female', 'Bhutanese', 'Sarpang', 'Gelephu Throm', 'Rabdeyling', 'Thimphu', '17796778', null, null);
INSERT INTO `tbl_institutiontypes_lookup` VALUES ('1', 'Government');
INSERT INTO `tbl_institutiontypes_lookup` VALUES ('2', 'Corporate');
INSERT INTO `tbl_institutiontypes_lookup` VALUES ('3', 'Autonomous');
INSERT INTO `tbl_institutiontypes_lookup` VALUES ('4', 'Private');
INSERT INTO `tbl_institutiontypes_lookup` VALUES ('5', 'Non-Governmental Organisations');
INSERT INTO `tbl_institutiontypes_lookup` VALUES ('6', ' Armed Forces');
INSERT INTO `tbl_institutiontypes_lookup` VALUES ('7', 'Religious Institutions');
INSERT INTO `tbl_institutiontypes_lookup` VALUES ('8', 'International Organisations');
INSERT INTO `tbl_interviewtypes_lookup` VALUES ('3', 'face-to-face', null, null);
INSERT INTO `tbl_interviewtypes_lookup` VALUES ('4', 'virtual', null, null);
INSERT INTO `tbl_investigationtype_lookup` VALUES ('4', 'Regular', null, null);
INSERT INTO `tbl_investigationtype_lookup` VALUES ('3', 'Special', null, null);
INSERT INTO `tbl_offences_lookup` VALUES ('4', 'ACAB 2011 Sec-42 ACTIVE Bribery OF Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('5', 'ACAB 2011 Sec-43 Passive Bribery OF Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('6', 'ACAB 2011 Sec-44 ACTIVE Bribery OF FOREIGN Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('7', 'ACAB 2011 Sec-45 Passive Bribery OF FOREIGN Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('8', 'ACAB 2011 Sec-46 ACTIVE Bribery IN Relation TO Auctions');
INSERT INTO `tbl_offences_lookup` VALUES ('9', 'ACAB 2011 Sec-47 Passive Bribery IN Relation TO Auctions');
INSERT INTO `tbl_offences_lookup` VALUES ('10', 'ACAB 2011 Sec-48 ACTIVE Bribery IN Relation TO Bids');
INSERT INTO `tbl_offences_lookup` VALUES ('11', 'ACAB 2011 Sec-49 Passive Bribery IN Relation TO Bids');
INSERT INTO `tbl_offences_lookup` VALUES ('12', 'ACAB 2011 Sec-50 ACTIVE Bribery IN Relation TO Contract');
INSERT INTO `tbl_offences_lookup` VALUES ('13', 'ACAB 2011 Sec-51 Passive Bribery IN Relation TO Contract');
INSERT INTO `tbl_offences_lookup` VALUES ('14', 'ACAB 2011 Sec-52 Embezzlement OF Funds OR Securities BY Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('15', 'ACAB 2011 Sec-53 Embezzlement OF Property BY Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('16', 'ACAB 2011 Sec-54 ACTIVE Trading IN Influence');
INSERT INTO `tbl_offences_lookup` VALUES ('17', 'ACAB 2011 Sec-55 ACTIVE Trading IN Influence Involving Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('18', 'ACAB 2011 Sec-56 Passive Trading IN Influence');
INSERT INTO `tbl_offences_lookup` VALUES ('19', 'ACAB 2011 Sec-57 Passive Trading IN Influence Involving Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('20', 'ACAB 2011 Sec-58 Commission Amounting TO Abuse OF Functions');
INSERT INTO `tbl_offences_lookup` VALUES ('21', 'ACAB 2011 Sec-59 Omission Amounting TO Abuse OF Functions');
INSERT INTO `tbl_offences_lookup` VALUES ('22', 'ACAB 2011 Sec-60 Possession OF Unexplained Wealth');
INSERT INTO `tbl_offences_lookup` VALUES ('23', 'ACAB 2011 Sec-61 Failure TO Protection Public Property AND Revenue');
INSERT INTO `tbl_offences_lookup` VALUES ('24', 'ACAB 2011 Sec-62 FALSE Claims BY Public Servant');
INSERT INTO `tbl_offences_lookup` VALUES ('25', 'ACAB 2011 Sec-63 Failure TO DECLARE Conflict OF Interest');
INSERT INTO `tbl_offences_lookup` VALUES ('26', 'ACAB 2011 Sec-64 FALSE Declarations WITH A VIEW TO Conceal');
INSERT INTO `tbl_offences_lookup` VALUES ('27', 'ACAB 2011 Sec-65 Abuse OF Privileged Information');
INSERT INTO `tbl_offences_lookup` VALUES ('28', 'ACAB 2011 Sec-66 ACTIVE Commercial Bribery');
INSERT INTO `tbl_offences_lookup` VALUES ('29', 'ACAB 2011 Sec-67 Passive Commercial Bribery');
INSERT INTO `tbl_offences_lookup` VALUES ('30', 'ACAB 2011 Sec-68 Embezzlement OF Fund OR Securities IN The Private Sector');
INSERT INTO `tbl_offences_lookup` VALUES ('31', 'ACAB 2011 Sec-69 Embezzlement OF Property IN The Private Sector');
INSERT INTO `tbl_offences_lookup` VALUES ('32', 'ACAB 2011 Sec-70 Money Laundering BY Converting OR Transferring Corruption Proceeds');
INSERT INTO `tbl_offences_lookup` VALUES ('33', 'ACAB 2011 Sec-71 Money Laundering BY Concealing OR Disguising Corruption Proceeds');
INSERT INTO `tbl_offences_lookup` VALUES ('34', 'ACAB 2011 Sec-72 Money Laundering BY Acquiring; Possessing OR USING Corruption Proceeds');
INSERT INTO `tbl_offences_lookup` VALUES ('35', 'ACAB 2011 Sec-73 Concealment OF Corruption Proceeds');
INSERT INTO `tbl_offences_lookup` VALUES ('36', 'ACAB 2011 Sec-74 Offences Relating TO Witnesses');
INSERT INTO `tbl_offences_lookup` VALUES ('37', 'ACAB 2011 Sec-74(A) ACTIVE OR Passive Bribery OF Witness');
INSERT INTO `tbl_offences_lookup` VALUES ('38', 'ACAB 2011 Sec-75 Participation IN An Offence');
INSERT INTO `tbl_offences_lookup` VALUES ('39', 'ACAB 2011 Sec-76 Predicate Offences');
INSERT INTO `tbl_parentagencies_lookup` VALUES ('1', 'Ministry of Economic Affairs');
INSERT INTO `tbl_parentagencies_lookup` VALUES ('2', 'Ministry of Education');
INSERT INTO `tbl_partytypes_lookup` VALUES ('1', 'Witness');
INSERT INTO `tbl_partytypes_lookup` VALUES ('2', 'Accused');
INSERT INTO `tbl_partytypes_lookup` VALUES ('3', 'Expert');
INSERT INTO `tbl_partytypes_lookup` VALUES ('4', 'Suspect');
INSERT INTO `tbl_priorities_lookup` VALUES ('1', 'High', '1');
INSERT INTO `tbl_priorities_lookup` VALUES ('2', 'Low', '1');
INSERT INTO `tbl_priorities_lookup` VALUES ('3', 'Medium', '1');
INSERT INTO `tbl_recommendationstatuses_lookup` VALUES ('1', 'Approved');
INSERT INTO `tbl_recommendationstatuses_lookup` VALUES ('2', 'Rejected');
INSERT INTO `tbl_registered_cases` VALUES ('1', 'RCO-052023-01', 'hthth hththth hth ththt thth', 'Reactive (Complaint)', 'Public', 'Land Administration', 'Monitoring and inspection', 'Private', 'kkkkkkkk llllllllllll mnnmnmn sdfjsk laskjflaskjdf alskjf laksjf laksjf alskfj laskjf laksjfiwejojlksjd fowdkjfl oiejflskj lskjfwoeifjd askdjfowiejflk lskdjfoeildk laskdjfowejf lkajdsfoiewjflk laskjdfeoijf alksjdfoeifk laksjdfoawie flaskjfowekfl lskdjfoweijfl laksjfowe laksjoweif lksjdflaks lksjd feijkd lsakjlfdka laskjd', 'yiuiy iyudfisuyf iahskfajh kajshd fkasj aisuhfkahs kasjhdf ie khjsfkjs fd iweufhksjhf kashdf ksahf aksieuhfkj kwjhefkwjhe fkajshfkasj kjhaksjhf kajhs fk alksjf lakj flaksj flaksj flaks flakjsdf laksjfoewir owiuerowie kjf', 'Low', 'Regular', 'Thimphu-branch I', null, '2023-05-02', null, '', 'Open', 'Active', 'Team Declared COI', null, null, '0', null, null);
INSERT INTO `tbl_registered_cases` VALUES ('2', 'POF-052023-01', 'judicial case', 'Proactive (Offshoot)', 'Private', 'Justice', 'Judicial Services', null, 'allegation details lkaldskf laks dflakjd lak df', 'nmsndf,msand,famns,dfmans,dfm', 'High', 'Regular', 'Thimphu-branch I', null, '2023-05-01', null, '', 'Open', 'Active', '4', null, null, '0', null, null);
INSERT INTO `tbl_registered_cases` VALUES ('3', 'PIN-052023-01', 'zyaa zyaa zyaa', 'Proactive (Intel)', 'Public', 'Sport', 'Judicial Services', 'Non-Governmental Organisations', 'allegations alskjdf laksdkjf lakds jf', 'af', 'High', 'Regular', 'Thimphu-branch II', null, '2023-05-03', null, '', 'Open', 'Active', 'Assignment Order Printed', null, 'mnbjk kjh kj k hjk', '0', null, null);
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('1', 'Agriculture and Forest');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('2', 'Construction');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('3', 'Environment');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('4', 'Education');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('5', 'Election');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('6', 'Energy and Power');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('7', 'Banking and Finance');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('8', 'Human Resource');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('9', 'Justice');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('10', 'Land Administration');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('11', 'Mining');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('12', 'Transportation');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('13', 'Tourism');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('14', 'Information Technology');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('15', 'Health Care');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('16', 'Telecommunication Service');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('17', 'Sport');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('18', 'Local Governance');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('19', 'Security');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('20', 'Religious and Cultural Activities');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('21', 'Housing');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('22', 'Media');
INSERT INTO `tbl_sectorsubtypes_lookup` VALUES ('23', 'Law and Order');
INSERT INTO `tbl_sectortypes_lookup` VALUES ('1', 'Private');
INSERT INTO `tbl_sectortypes_lookup` VALUES ('2', 'Public');
INSERT INTO `tbl_seizuretypes_lookup` VALUES ('1', 'Digital Items');
INSERT INTO `tbl_seizuretypes_lookup` VALUES ('2', 'Emails');
INSERT INTO `tbl_seizuretypes_lookup` VALUES ('3', 'Social Media');
INSERT INTO `tbl_seizuretypes_lookup` VALUES ('4', 'Passport');
INSERT INTO `tbl_seizuretypes_lookup` VALUES ('5', 'Currency');
INSERT INTO `tbl_sources_lookup` VALUES ('1', 'Reactive (Complaint)', null, null);
INSERT INTO `tbl_sources_lookup` VALUES ('2', 'Reactive (Agency Referral)', null, null);
INSERT INTO `tbl_sources_lookup` VALUES ('3', 'Proactive (Offshoot)', null, null);
INSERT INTO `tbl_sources_lookup` VALUES ('5', 'Proactive (Intel)', null, null);
INSERT INTO `tbl_task_types_lookup` VALUES ('1', 'Planning', '2022-07-18 11:30:55', '2022-07-18 11:30:55');
INSERT INTO `tbl_task_types_lookup` VALUES ('2', 'Information Gathering', '2022-07-18 11:31:00', '2022-07-18 11:31:00');
INSERT INTO `tbl_task_types_lookup` VALUES ('3', 'Interview', '2022-07-18 11:31:09', '2022-07-18 11:31:09');
INSERT INTO `tbl_task_types_lookup` VALUES ('4', 'Search and Seizure', '2022-07-18 11:31:21', '2022-07-18 11:31:21');
INSERT INTO `tbl_task_types_lookup` VALUES ('5', 'Arrest and Detention', '2022-07-18 11:31:35', '2022-07-18 11:31:35');
INSERT INTO `tbl_task_types_lookup` VALUES ('6', 'Reporting', '2022-07-18 11:31:42', '2022-07-18 11:31:42');
INSERT INTO `tbl_user_role_mapping` VALUES ('5', 'director@gmail.com', 'chief@gmail.com', 'Chief', '2023-05-02 07:18:48', '1', null);
INSERT INTO `tbl_user_role_mapping` VALUES ('6', 'chief@gmail.com', 'investigator@gmail.com', 'Team Member', '2023-05-02 07:21:49', '1', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('7', 'chief@gmail.com', 'anju@gmail.com', 'Team Leader', '2023-05-02 07:21:49', '1', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('8', 'chief@gmail.com', 'jk@gmail.com', 'Legal Representative', '2023-05-02 07:21:49', '1', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('9', 'director@gmail.com', 'chief@gmail.com', 'Chief', '2023-05-02 10:08:51', '2', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('10', 'chief@gmail.com', 'investigator@gmail.com', 'Team Member', '2023-05-02 10:31:36', '2', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('11', 'chief@gmail.com', 'anju@gmail.com', 'Team Leader', '2023-05-02 10:31:36', '2', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('12', 'chief@gmail.com', 'jk@gmail.com', 'Legal Representative', '2023-05-02 10:31:36', '2', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('13', 'director@gmail.com', 'xyz@gmail.com', 'Chief', '2023-05-03 04:19:27', '3', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('14', 'xyz@gmail.com', 'investigator@gmail.com', 'Team Member', '2023-05-03 04:21:04', '3', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('15', 'xyz@gmail.com', 'anju@gmail.com', 'Legal Representative', '2023-05-03 04:21:04', '3', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('16', 'xyz@gmail.com', 'jk@gmail.com', 'Team Leader', '2023-05-03 04:21:04', '3', '1');
INSERT INTO `tbl_user_role_mapping` VALUES ('17', 'director@gmail.com', 'commissioner@gmail.com', 'Commissioner', '2023-05-03 04:21:04', '3', '1');
INSERT INTO `users` VALUES ('1', '1', 'Accepted', 'Dorji Tenzin', 'chief@gmail.com', 'Tashi1234', '$2y$10$x5pzx1/k1GDtVs9v3QpbYOFIk5vKyrCTytvo44pHAwfiMLyuOecYq', null, 'Chief', null, '111111', 'Department of Investigation', 'Thimphu-branch I', 'Chief, Branch I', '111111', 'wewr', null, 'TCNq0Uxw79uGg0zNzHww4PQ0cH5qRLQrXOPYtlaW7PpWosrkrpwhilWm759K', '2022-02-09 00:10:17', '2022-02-10 01:14:05', null, null);
INSERT INTO `users` VALUES ('2', '1', 'Accepted', 'Gyeltshen', 'director@gmail.com', 'Wangmo', '$2y$10$J3ciAxDLffRtm6VOs0TbwOzbN2tUkSpDpiI.xRKGQPOdewJ7/PI7y', null, 'Director', null, '45657657', 'Department of Investigation', 'Thimphu-branch I', 'designation 2', '67543212', null, null, null, '2022-02-26 06:48:03', '2022-02-26 06:53:50', 'mother\'s maiden name', 'dema');
INSERT INTO `users` VALUES ('4', '1', 'Accepted', 'Pema', 'cc@gmail.com', 'ggdd', '$2y$10$J3ciAxDLffRtm6VOs0TbwOzbN2tUkSpDpiI.xRKGQPOdewJ7/PI7y', null, 'Investigator', null, '45634557657', 'Department of Investigation', 'Thimphu-branch I', 'designation 2', '67543453212', null, null, null, '2022-02-26 00:48:03', '2022-02-26 00:53:50', 'mother\'s maiden name', 'dema');
INSERT INTO `users` VALUES ('6', '1', 'Rejected', 'Tshering', 'sarada@itechnologies.bt', 'Wangmo', '$2y$10$J3ciAxDLffRtm6VOs0TbwOzbN2tUkSpDpiI.xRKGQPOdewJ7/PI7y', null, 'Admin', null, '4565227657', 'Department of Investigation', 'Thimphu-branch I', 'designation 2', '67543212', null, null, null, '2022-02-26 00:48:03', '2022-10-18 03:52:18', 'mother\'s maiden name', 'dema');
INSERT INTO `users` VALUES ('188', '1', 'Accepted', 'Kinley', 'commissioner@gmail.com', 'sfsf', '$2y$10$v/K4vUkchyG64dxOpKbdke72v6D7X0tTyRmYOvLzs3lNmaniqMjHC', null, 'Commission', null, '3525', 'Commission', 'Thimphu-branch I', 'Chief', '23523523', null, null, null, '2022-05-19 00:06:07', '2022-05-19 02:57:24', 'city were you born', 'dasdfa');
INSERT INTO `users` VALUES ('185', '1', 'Accepted', 'Garab Dorji-investigator', 'investigator@gmail.com', 'sfsf', '$2y$10$XEQBnDBkgX1Bp4npt6GiauzfXlcY30eQdvs90x1nRoZ3lt8syXcOS', '2023011104086895209.png', 'Investigator', '', '3525', 'Department of Investigation', 'Thimphu-branch II', 'Chief', '23523523', '', '0000-00-00 00:00:00', '', '2022-05-19 00:06:07', '2023-01-11 04:08:21', 'city were you born', 'dasdfa');
INSERT INTO `users` VALUES ('190', '1', 'Accepted', 'Anju', 'anju@gmail.com', 'Anju', '$2y$10$x5pzx1/k1GDtVs9v3QpbYOFIk5vKyrCTytvo44pHAwfiMLyuOecYq', null, 'Investigator', '', '111111', 'Department of Investigation', 'Thimphu-branch I', 'Designation 1', '111111', 'wewr', '0000-00-00 00:00:00', 'lqr9szUMI50DVTB0KaT8DYkBW43rAV35Bseia05aBUHStWsJO5XGN8l1dRjY', '2022-02-09 00:10:17', '2022-02-10 01:14:05', '', '');
INSERT INTO `users` VALUES ('5', '1', 'Accepted', 'Sarda', 's@gmail.com', 'Sarda', '$2y$10$x5pzx1/k1GDtVs9v3QpbYOFIk5vKyrCTytvo44pHAwfiMLyuOecYq', null, 'Chief', null, '1234543', 'Forensics', 'Thimphu-branch I', 'designation 2', '23343423', 'dgdg', null, null, '2022-06-03 21:54:56', '2022-06-03 21:54:56', null, null);
INSERT INTO `users` VALUES ('197', '1', 'Accepted', 'Dechen Wangmo', 'aa@gmail.com', 'Aa', '$2y$10$Bccbf5QPFMMFZs1lyHbN0ud0DGR9e0f2mYwP.iu1VhGgzV.68aeqy', null, 'gadget_admin', null, '345678', 'Commission', 'Thimphu-branch I', 'Chief', '3456789', 'skfjskf', null, null, '2022-10-18 04:24:12', '2022-10-18 04:37:45', 'city were you born', 'Sarpang');
INSERT INTO `users` VALUES ('198', '1', 'Accepted', 'Dema', 'jk@gmail.com', 'kj', '$2y$10$v/K4vUkchyG64dxOpKbdke72v6D7X0tTyRmYOvLzs3lNmaniqMjHC', null, 'Investigator', null, '1312324', 'Department of Investigation', 'Thimphu-branch I', 'Investigator', '23423423', 'lskjf', null, null, '2022-10-18 04:27:51', '2022-10-18 04:28:26', null, null);
INSERT INTO `users` VALUES ('207', '0', 'Not Accepted', 'Sarada Acharya', 'saradachr36@gmail.com', 'Sarada', '', null, 'Investigator', null, '543799768', 'Department of Investigation', 'Thimphu-branch III', 'Chief', '17796778', 'sdad', null, null, '2022-12-28 04:32:16', '2022-12-28 05:00:24', 'city were you born', 'Sarpang');
INSERT INTO `users` VALUES ('7', '1', 'Accepted', 'Lhamo', 'ff@gmail.com', 'Lhamo', '$2y$10$x5pzx1/k1GDtVs9v3QpbYOFIk5vKyrCTytvo44pHAwfiMLyuOecYq', '', 'Forensic Officer', '', '1234543', 'Forensics', 'Thimphu-branch I', 'designation 2', '23343423', 'dgdg', '0000-00-00 00:00:00', '', '2022-06-03 21:54:56', '2022-06-03 21:54:56', '', '');
INSERT INTO `users` VALUES ('189', '1', 'Accepted', 'Karma', 'xyz@gmail.com', 'Karma', '$2y$10$x5pzx1/k1GDtVs9v3QpbYOFIk5vKyrCTytvo44pHAwfiMLyuOecYq', '', 'Chief', '', '1234543', 'Department of Investigation', 'Thimphu-branch II', 'designation 2', '23343423', 'dgdg', '0000-00-00 00:00:00', '', '2022-06-03 21:54:56', '2022-06-03 21:54:56', '', '');
