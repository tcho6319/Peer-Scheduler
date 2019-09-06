## Database Schema 
Table: posts
* id: type - INTEGER, constraints - PK, U, Not, AI
* term_id: type - INTEGER, constraints - Not
* year_id: type - INTEGER, constraints - Not
* school_id: type - INTEGER, constraints - Not
* image_id: type - INTEGER, constraints - U, Not
* a_description: type - TEXT


Table: images
* id: type - INTEGER, constraints - PK, U, Not, AI
* citation: type - TEXT, constraints - Not
* img_ext: type - TEXT, constraints - Not

Table: terms
* id: type - INTEGER, constraints - PK, U, Not, AI
* term: type - TEXT, constraints - U, Not

Table: years
* id: type - INTEGER, constraints - PK, U, Not, AI
* year: type - TEXT, constraints - U, Not

Table: majors
* id: type - INTEGER, constraints - PK, U, Not, AI
* major: type - TEXT, constraints - U, Not

Table: minors
* id: type - INTEGER, constraints - PK, U, Not, AI
* mionr: type - TEXT, constraints - U, Not

Table: schools
* id: type - INTEGER, constraints - PK, U, Not, AI
* school: type - TEXT, constraints - U, Not

Table: tracks
* id: type - INTEGER, constraints - PK, U, Not, AI
* track: type - TEXT, constraints - U, Not

Table: comments
* id: type - INTEGER, constraints - PK, U, Not, AI
* comment: type - TEXT, constraints - Not


Table: post_majors
* id: type - INTEGER, constraints - PK, U, Not, AI
* post_id: type - INTEGER, constraints - Not
* major_id: type - INTEGER, constraints - Not

Table: post_minors
* id: type - INTEGER, constraints - PK, U, Not, AI
* post_id: type - INTEGER, constraints - Not
* minor_id: type - INTEGER, constraints - Not


Table: post_tracks
* id: type - INTEGER, constraints - PK, U, Not, AI
* post_id: type - INTEGER, constraints - Not
* track_id: type - INTEGER, constraints - Not

Table: post_comments
* id: type - INTEGER, constraints - PK, U, Not, AI
* post_id: type - INTEGER, constraints - Not
* comment_id: type - TEXT, constraints - Not

