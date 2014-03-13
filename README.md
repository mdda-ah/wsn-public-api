# MDDA Wireless Sensor Network API v1.0

# Documentation v1.1.1

Last updated 2014-03-12.

([The API Changelog is on another page…](/docs/changes.html))

# Introduction

This is a read-only API for consuming data collected from on-street environmental sensors in Manchester, UK.

The API accepts HTTP GET requests and returns JSON data. The methods and parameters are listed below, along with example requests and responses.

The sensors have been deployed as part of a test project to clarify the viability of deploying Wireless Sensor Networks using low cost equipment.

## Contact
If you have any questions or suggestions for improvement, please contact Alan Holding, Manchester Digital Development Agency, Manchester City Council. Email: a.holding@manchesterdda.com.

## Caveats
The data provided may not be scientifically accurate given that the project is using "low-cost" equipment as part of the project trials.

# Endpoint
	http://wsn-api.manchesterdda.net/v1/

# Methods
Methods are listed below showing HTTP request method (e.g. GET) and the URL "path" for the method (e.g. /ping).

## GET /

Provides a basic "about the API" message.

### Example request
	http://wsn-api.manchesterdda.net/v1/

### Example response
	{"message":"Hi. This is the MDDA Wireless Sensor Network API v1.0"}

## GET /ping
Provides a simple ""OK" if the API is working fine. This method will be expanded to include more diagnostic information in the future.

### Example request
	http://wsn-api.manchesterdda.net/v1/ping

### Example response
	{"message":"OK"}

## GET /units/info/all
Provides metadata about the sensor units that have been deployed to date.

### Fields
* device_id: Reference name for the sensor unit.
* location_name: Readable name for where the sensor unit is located.
* latitude: Latitude of the geolocation of the unit. Uses WGS84 (e.g. Google Maps).
* longitude: Longitude of the geolocation of the unit. Uses WGS84 (e.g. Google Maps).
* elevation_above_ground: The elevation above ground in metres where the sensor unit is located.
* sensor_types_available: A comma separated list of sensor type IDs avalable on the sensor unit. Please use the /units/info/sensor_types method to get metadata about each sensor_type.

### Example request
	http://wsn-api.manchesterdda.net/v1/units/info/all

### Example response
	{
			"message": "OK",
			"data": [
					{
							"device_id": "WASP0010",
							"location_name": "Manchester Town Hall Moat",
							"longitude": -2.24481,
							"latitude": 53.4792,
							"elevation_above_ground": 0,
							"date_deployed": "2014-01-16",
							"sensor_types_available": "1,5,999"
					},
					…
			]
	}

## GET /units/info/[DEVICE_ID]
Provides metadata about a specific sensor unit.

The [DEVICE_ID] parameter should match an existing device_id. You can use the GET /units/info/all method to get a list of device_ids. (A specific /units/info/device_ids method will be added in the next release.)

### Fields
Please see the list given in the /units/info/all method.

### Example request
	http://wsn-api.manchesterdda.net/v1/units/info/WASP0011

### Example response
	{
			"message": "OK",
			"data": [
					{
							"device_id": "WASP0011",
							"location_name": "Manchester Town Hall Clock Tower",
							"longitude": -2.24454,
							"latitude": 53.4793,
							"elevation_above_ground": 77,
							"date_deployed": "2014-01-16",
							"sensor_types_available": "1,4,5,999"
					}
			]
	}

## GET /units/info/sensor_types
Provides information about the sensors that have been deployed on the sensor units.

### Fields
* sensor_type_id: UID for the sensor.
* name: Friendly name of the sensor.
* data_type: What "type" of data is reported by the sensor.
* bounds_low: Minimum sensitivity of the sensor.
* bounds_low: Maximum sensitivity of the sensor.

### Example request
	http://wsn-api.manchesterdda.net/v1/units/info/sensor_types

### Example response

	{
	    "message": "OK",
	    "data": [
	        {
	            "sensor_type_id": 1,
	            "name": "Temperature",
	            "data_type": "Centigrade",
	            "bounds_low": -20,
	            "bounds_high": 40
	        },
			…
	    ]
	}

## GET /units/data/all
Provides the latest readings from all sensors units, sorted by most recent date and time. Defaults to the latest 100 readings.

### Fields
* datetime: The datetime the reading was reported by the sensor unit. Dates and times are given in UTC, so you will need to support timezones in your own app.
* device_id: ID of the sensor unit which reported the reading.
* sensor_id: ID of the sensor which data was collected from. This matched the sensor_type_ids provided by the /units/info/sensor_types method.
* value: The "reading" provided by the sensor. Please refer to the metadata provided by the /units/info/sensor_types method to clarify what data type this value is given in, e.g. centigrade.
* bounds_flag: Flag showing if the value reported is within or outside the sensors reliable range of detection. 0 = OK. -1 = Below usable detection range. 1 = Above usable detection range. Any readings which report values other than 0 should be regarded as "dodgy data".
* latitude: Latitude of the geolocation of the unit. Uses WGS84 (e.g. Google Maps).
* longitude: Longitude of the geolocation of the unit. Uses WGS84 (e.g. Google Maps).
* elevation_above_ground: The elevation above ground in metres where the sensor unit is located.
* nodecounter: Counter used in diagnostic routines on the sensor unit. Resets every 100 readings or when the sensor unit "reboots".
* coordcounter: Counter used in diagnostic routines on the data collection units. Can spot when a data collection unit has "rebooted" as this value resets to 1.

### Parameters
Please note that a date range parameter will be added in the next release.

#### limit
Limit the number of readings returned. Max 1000.

#### sensor_type_id
Limit the readings to a specific sensor type. Please use the /units/info/sensor_types method to get a list of sensor_type_ids to use. Only one sensor type ID can be specified.

### Example requests
	http://wsn-api.manchesterdda.net/v1/units/data/all
	http://wsn-api.manchesterdda.net/v1/units/data/all?limit=400
	http://wsn-api.manchesterdda.net/v1/units/data/all?sensor_type_id=1
	http://wsn-api.manchesterdda.net/v1/units/data/all?limit=400&sensor_type_id=1

### Example response
	{
			"message": "OK",
			"data": [
					{
							"datetime": "2014-02-18 20:34:37",
							"device_id": "WASP0013",
							"sensor_id": 5,
							"value": 2.1187277838407,
							"bounds_flag": 0,
							"latitude": 53.4703,
							"longitude": -2.23934,
							"elevation_above_ground": 6,
							"nodecounter": 37,
							"coordcounter": 210
					},
					…
				]
		 ]
	}

## GET /units/data/[DEVICE_ID]
Provides the latest readings from a specific sensor unit, sorted by most recent date and time. Defaults to the latest 100 readings.

The [DEVICE_ID] parameter should match an existing device_id. You can use the GET /units/info/all method to get a list of device_ids. (A specific /units/info/device_ids method will be added in the next release.)

### Fields
Please see the fields listed in the /units/data/all method.

### Parameters
This method allows the same parameters as the /units/data/all method.

### Example requests
	http://wsn-api.manchesterdda.net/v1/units/data/wasp0010
	http://wsn-api.manchesterdda.net/v1/units/data/wasp0010?limit=400
	http://wsn-api.manchesterdda.net/v1/units/data/wasp0010?sensor_type_id=1
	http://wsn-api.manchesterdda.net/v1/units/data/wasp0010?limit=400&sensor_type_id=1

### Example response
	{
			"message": "OK",
			"data": [
					{
							"datetime": "2014-02-18 20:34:37",
							"device_id": "WASP0013",
							"sensor_id": 5,
							"value": 2.1187277838407,
							"bounds_flag": 0,
							"latitude": 53.4703,
							"longitude": -2.23934,
							"elevation_above_ground": 6,
							"nodecounter": 37,
							"coordcounter": 210
					},
					…
				]
		 ]
	}

## GET /units/data/latest
Provides the latest readings from each of the deployed sensor units from the last time they reported.

### Fields
Please see the fields listed in the /units/data/all method.

### Example requests
	http://wsn-api.manchesterdda.net/v1/units/data/latest

### Example response
	{
			"message": "OK",
			"data": [
					{
							"datetime": "2014-02-18 20:34:37",
							"device_id": "WASP0013",
							"sensor_id": 5,
							"value": 2.1187277838407,
							"bounds_flag": 0,
							"latitude": 53.4703,
							"longitude": -2.23934,
							"elevation_above_ground": 6,
							"nodecounter": 37,
							"coordcounter": 210
					},
					…
				]
		 ]
	}

## GET /units/status/battery
Provides the battery charge percentage level from each of the deployed sensor units from the last time they reported in.

### Fields
* device_id: ID of the sensor unit which reported the reading.
* location_name: Readable name for where the sensor unit is located.
* datetime: The datetime the reading was reported by the sensor unit. Dates and times are given in UTC, so you will need to support timezones in your own app.
* battery_charge: The battery charge level of the unit as a percentage.

### Example requests
	http://wsn-api.manchesterdda.net/v1/units/status/battery

### Example response
	{
	    "message": "OK",
	    "data": [
	        {
	            "device_id": "WASP0010",
	            "location_name":"Manchester Town Hall Moat",
	            "datetime": "2014-03-12 11:25:41",
	            "battery_charge": 54
	        },
			…
	    ]
	}
