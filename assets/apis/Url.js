const BASE_URL = 'http://localhost:81';
const LOCALE = 'LOCALE';

/* homepage */
export const RANDOM_VERSE = BASE_URL + '/' + LOCALE + '/api/quran/chapters/verses/random';

/* quran */
export const CHAPTER_LIST = BASE_URL + '/' + LOCALE + '/api/quran/chapters';
export const CHAPTER_DETAILS = BASE_URL + '/' + LOCALE + '/api/quran/chapters/ID';

/* web */
export const WEB_CHAPTER_DETAILS = BASE_URL + '/' + LOCALE + '/quran/chapter/ID';
export const WEB_CONTEXT_GROUP_DETAILS = BASE_URL + '/' + LOCALE + '/context/group/ID';

/* Context */
export const CONTEXT_GROUP_LIST = BASE_URL + '/' + LOCALE + '/api/contexts/groups';
export const CONTEXT_GROUP_DETAILS = BASE_URL + '/' + LOCALE + '/api/contexts/groups/ID';
