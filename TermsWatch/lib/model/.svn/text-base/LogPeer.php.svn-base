<?php

class LogPeer extends BaseLogPeer
{
	// outcome codes for scrapes
	const OUTCOME_NOCHANGES = 0;
	const OUTCOME_FIRSTSCRAPE = 1;
	const OUTCOME_CHANGESFOUND = 2;
	const OUTCOME_ERROR = 3;
	const ADJUSTED_DELETED = 4;
	const ADJUSTED_NEWFIRST = 5;
	const WAYBACK = 6;
	const OUTCOME_ERROR_EMPTY = 7;
	const OUTCOME_ERROR_REGEX = 8;
	const OUTCOME_ERROR_INSERT_REVISION = 9;
	const OUTCOME_ERROR_INSERT_NEW = 10;
	
	// outcome codes from new scrape program
	const LOG_SCRAPE_ERROR = -2;
	const LOG_CONNECTION_ERROR = -1;
	const LOG_NOTHING = OUTCOME_NOCHANGES;
	const LOG_NEW = OUTCOME_FIRSTSCRAPE;
	const LOG_UPDATE = OUTCOME_CHANGESFOUND;
}
