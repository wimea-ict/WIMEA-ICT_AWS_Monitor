/* eslint-disable no-var */
const mysql = require('mysql');

function callback(QUERY, masterObjectCopy, stationname, callbackfunc) {
  // db init connetions pool
  const pool = mysql.createPool({
    connectionLimit: 5,
    host: 'localhost',
    user: '',
    password: '',
    database: 'wdrDb',
  });

  pool.query(QUERY, (queryError, result, fields) => {
    if (queryError) {
      throw queryError;
    } else if (result.length > 0) {
      callbackfunc(result[0].station_id, masterObjectCopy, pool);
    } else {
      const STATION_NAMES = {
        ebb: 55,
	    ebbg3: 66,
        myg: 54,
        makg3: 53,
        kml: 52
        /** duplicates to bend the rules for naming errors */

      };

      callbackfunc(STATION_NAMES[stationname], masterObjectCopy, pool);
    }
  });
}

module.exports = callback;
