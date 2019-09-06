BEGIN TRANSACTION;

-- Uploaders Table
CREATE TABLE posts (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    term_id INTEGER NOT NULL,
    year_id INTEGER NOT NULL,
    school_id INTEGER NOT NULL,
    image_id INTEGER NOT NULL UNIQUE,
    a_description TEXT
);

-- Images Table
CREATE TABLE images (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    citation TEXT,
    img_ext TEXT NOT NULL
);

-- Terms Table
CREATE TABLE terms (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    term TEXT NOT NULL UNIQUE
);

-- Years Table
CREATE TABLE years (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    year TEXT NOT NULL UNIQUE
);

-- Majors Table
CREATE TABLE majors (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    major TEXT NOT NULL UNIQUE
);

-- Minors Table
CREATE TABLE minors (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    minor TEXT NOT NULL UNIQUE
);

-- Schools Table
CREATE TABLE schools (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    school TEXT NOT NULL UNIQUE
);

--Tracks table
CREATE TABLE tracks (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    track TEXT NOT NULL UNIQUE
);

--Comments table
CREATE TABLE comments (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    comment TEXT NOT NULL 
);

-- post_majors Table
CREATE TABLE post_majors (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    post_id INTEGER NOT NULL,
    major_id INTEGER NOT NULL
);

-- post_minors Table
CREATE TABLE post_minors (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    post_id INTEGER NOT NULL,
    minor_id INTEGER NOT NULL
);

-- post_tracks Table
CREATE TABLE post_tracks (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    post_id INTEGER NOT NULL,
    track_id INTEGER NOT NULL
);

-- post_comments Table
CREATE TABLE post_comments (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    post_id INTEGER NOT NULL,
    comment_id TEXT NOT NULL
);


--posts table seed data
INSERT INTO posts (id, term_id, year_id, school_id, image_id, a_description) VALUES (1, 1, 2, 5, 1, 'I was wondering if I could get some feedback on my schedule. Is it too light? Thanks!');
INSERT INTO posts (id, term_id, year_id, school_id, image_id, a_description) VALUES (2, 3, 3, 1, 2, 'Hi, this is a snapshot of my four year plan at the moment. I would like to go into either software development or data science later on. Feedback would be much appreciated!');
INSERT INTO posts (id, term_id, year_id, school_id, image_id) VALUES (3, 3, 3, 5, 3);
INSERT INTO posts (id, term_id, year_id, school_id, image_id) VALUES (4, 2, 3, 6, 4);
INSERT INTO posts (id, term_id, year_id, school_id, image_id) VALUES (5, 2, 3, 5, 5);
INSERT INTO posts (id, term_id, year_id, school_id, image_id) VALUES (6, 2, 3, 1, 6);





--Images table seed data
INSERT INTO images (id, citation, img_ext) VALUES (1, 'Theresa Cho', 'png'); 
INSERT INTO images (id, citation, img_ext) VALUES (2, 'Theresa Cho', 'png'); 
INSERT INTO images (id, citation, img_ext) VALUES (3, 'Julia Radzio', 'jpg');
INSERT INTO images (id, citation, img_ext) VALUES (4, 'Lauren Kazen', 'jpg');
INSERT INTO images (id, citation, img_ext) VALUES (5, 'Julia Radzio', 'png');   
INSERT INTO images (id, citation, img_ext) VALUES (6, 'Theresa Cho', 'png'); 




--Terms table seed data
INSERT INTO terms (id, term) VALUES (1, 'spring');
INSERT INTO terms (id, term) VALUES (2, 'fall');
INSERT INTO terms (id, term) VALUES (3, 'four_year_plan');
INSERT INTO terms (id, term) VALUES (4, 'actual_four_year_plan');



--Years table seed data
INSERT INTO years (id, year) VALUES (1, 'freshman');
INSERT INTO years (id, year) VALUES (2, 'sophomore');
INSERT INTO years (id, year) VALUES (3, 'junior');
INSERT INTO years (id, year) VALUES (4, 'senior');
INSERT INTO years (id, year) VALUES (5, 'alumni');




--Majors table seed data
INSERT INTO majors (id, major) VALUES (1, 'africana studies');
INSERT INTO majors (id, major) VALUES (2, 'agricultural sciences');
INSERT INTO majors (id, major) VALUES (3, 'american studies');
INSERT INTO majors (id, major) VALUES (4, 'animal science');
INSERT INTO majors (id, major) VALUES (5, 'anthropology');
INSERT INTO majors (id, major) VALUES (6, 'applied economics and management');
INSERT INTO majors (id, major) VALUES (7, 'archaeology');
INSERT INTO majors (id, major) VALUES (8, 'architecture');
INSERT INTO majors (id, major) VALUES (9, 'asian studies');
INSERT INTO majors (id, major) VALUES (10, 'astronomy');
INSERT INTO majors (id, major) VALUES (11, 'atmospheric science');
INSERT INTO majors (id, major) VALUES (12, 'biological engineering');
INSERT INTO majors (id, major) VALUES (13, 'biological sciences');
INSERT INTO majors (id, major) VALUES (14, 'biology and society');
INSERT INTO majors (id, major) VALUES (15, 'biomedical engineering');
INSERT INTO majors (id, major) VALUES (16, 'biometry and statistics');
INSERT INTO majors (id, major) VALUES (17, 'chemical engineering');
INSERT INTO majors (id, major) VALUES (18, 'chemistry and chemical biology');
INSERT INTO majors (id, major) VALUES (19, 'china and asia-pacific studies');
INSERT INTO majors (id, major) VALUES (20, 'civil engineering');
INSERT INTO majors (id, major) VALUES (21, 'classics (classics, classical civ., greek, latin)');
INSERT INTO majors (id, major) VALUES (22, 'college scholar program');
INSERT INTO majors (id, major) VALUES (23, 'communication');
INSERT INTO majors (id, major) VALUES (24, 'comparative literature');
INSERT INTO majors (id, major) VALUES (25, 'computer science');
INSERT INTO majors (id, major) VALUES (26, 'design and environmental analysis');
INSERT INTO majors (id, major) VALUES (27, 'development sociology');
INSERT INTO majors (id, major) VALUES (28, 'earth and atmospheric sciences');
INSERT INTO majors (id, major) VALUES (29, 'economics');
INSERT INTO majors (id, major) VALUES (30, 'electrical and computer engineering');
INSERT INTO majors (id, major) VALUES (31, 'engineering physics');
INSERT INTO majors (id, major) VALUES (32, 'english');
INSERT INTO majors (id, major) VALUES (33, 'entomology');
INSERT INTO majors (id, major) VALUES (34, 'environmental and sustainability sciences');
INSERT INTO majors (id, major) VALUES (35, 'environmental engineering');
INSERT INTO majors (id, major) VALUES (36, 'feminist gender & sexuality studies');
INSERT INTO majors (id, major) VALUES (37, 'fiber science and apparel design');
INSERT INTO majors (id, major) VALUES (38, 'fine arts');
INSERT INTO majors (id, major) VALUES (39, 'food science');
INSERT INTO majors (id, major) VALUES (40, 'french');
INSERT INTO majors (id, major) VALUES (41, 'german studies');
INSERT INTO majors (id, major) VALUES (42, 'global & public health sciences');
INSERT INTO majors (id, major) VALUES (43, 'government');
INSERT INTO majors (id, major) VALUES (44, 'history');
INSERT INTO majors (id, major) VALUES (45, 'history of architecture (transfer students only)');
INSERT INTO majors (id, major) VALUES (46, 'history of art');
INSERT INTO majors (id, major) VALUES (47, 'hotel administration');
INSERT INTO majors (id, major) VALUES (48, 'human biology');
INSERT INTO majors (id, major) VALUES (49, 'health and society');
INSERT INTO majors (id, major) VALUES (50, 'human development');
INSERT INTO majors (id, major) VALUES (51, 'independent major—arts and sciences');
INSERT INTO majors (id, major) VALUES (52, 'independent major—engineering');
INSERT INTO majors (id, major) VALUES (53, 'industrial and labor relations');
INSERT INTO majors (id, major) VALUES (54, 'information science');
INSERT INTO majors (id, major) VALUES (55, 'information science, systems, and technology');
INSERT INTO majors (id, major) VALUES (56, 'interdisciplinary studies');
INSERT INTO majors (id, major) VALUES (57, 'international agriculture and rural development');
INSERT INTO majors (id, major) VALUES (58, 'italian');
INSERT INTO majors (id, major) VALUES (59, 'landscape architecture');
INSERT INTO majors (id, major) VALUES (60, 'linguistics');
INSERT INTO majors (id, major) VALUES (61, 'materials science and engineering');
INSERT INTO majors (id, major) VALUES (62, 'mathematics');
INSERT INTO majors (id, major) VALUES (63, 'mechanical engineering');
INSERT INTO majors (id, major) VALUES (64, 'music');
INSERT INTO majors (id, major) VALUES (65, 'near eastern studies');
INSERT INTO majors (id, major) VALUES (66, 'nutritional sciences');
INSERT INTO majors (id, major) VALUES (67, 'operations research and engineering');
INSERT INTO majors (id, major) VALUES (68, 'performing and media arts');
INSERT INTO majors (id, major) VALUES (69, 'philosophy');
INSERT INTO majors (id, major) VALUES (70, 'physics');
INSERT INTO majors (id, major) VALUES (71, 'plant sciences');
INSERT INTO majors (id, major) VALUES (72, 'policy analysis and management');
INSERT INTO majors (id, major) VALUES (73, 'psychology');
INSERT INTO majors (id, major) VALUES (74, 'religious studies');
INSERT INTO majors (id, major) VALUES (75, 'science and technology studies');
INSERT INTO majors (id, major) VALUES (76, 'sociology');
INSERT INTO majors (id, major) VALUES (77, 'spanish');
INSERT INTO majors (id, major) VALUES (78, 'statistical science');
INSERT INTO majors (id, major) VALUES (79, 'urban and regional studies');
INSERT INTO majors (id, major) VALUES (80, 'viticulture and enology');



--Minors table seed data
INSERT INTO minors (id, minor) VALUES (1, 'aerospace engineering');
INSERT INTO minors (id, minor) VALUES (2, 'africana studies');
INSERT INTO minors (id, minor) VALUES (3, 'agribusiness management');
INSERT INTO minors (id, minor) VALUES (4, 'american indian and indigenous studies');
INSERT INTO minors (id, minor) VALUES (5, 'american studies');
INSERT INTO minors (id, minor) VALUES (6, 'animal science');
INSERT INTO minors (id, minor) VALUES (7, 'anthropology');
INSERT INTO minors (id, minor) VALUES (8, 'applied economics');
INSERT INTO minors (id, minor) VALUES (9, 'applied exercise science');
INSERT INTO minors (id, minor) VALUES (10, 'applied mathematics');
INSERT INTO minors (id, minor) VALUES (11, 'arabic');
INSERT INTO minors (id, minor) VALUES (12, 'archaeology');
INSERT INTO minors (id, minor) VALUES (13, 'architecture');
INSERT INTO minors (id, minor) VALUES (14, 'asian american studies');
INSERT INTO minors (id, minor) VALUES (15, 'astronomy');
INSERT INTO minors (id, minor) VALUES (16, 'atmospheric science');
INSERT INTO minors (id, minor) VALUES (17, 'biological engineering');
INSERT INTO minors (id, minor) VALUES (18, 'biological sciences');
INSERT INTO minors (id, minor) VALUES (19, 'biomedical engineering');
INSERT INTO minors (id, minor) VALUES (20, 'biomedical sciences');
INSERT INTO minors (id, minor) VALUES (21, 'biometry and statistics');
INSERT INTO minors (id, minor) VALUES (22, 'business');
INSERT INTO minors (id, minor) VALUES (23, 'business for engineering students');
INSERT INTO minors (id, minor) VALUES (24, 'china and asia-pacific studies');
INSERT INTO minors (id, minor) VALUES (25, 'civil infrastructure');
INSERT INTO minors (id, minor) VALUES (26, 'classical civilization');
INSERT INTO minors (id, minor) VALUES (27, 'classics');
INSERT INTO minors (id, minor) VALUES (28, 'climate change');
INSERT INTO minors (id, minor) VALUES (29, 'cognitive science');
INSERT INTO minors (id, minor) VALUES (30, 'communication');
INSERT INTO minors (id, minor) VALUES (31, 'comparative literature');
INSERT INTO minors (id, minor) VALUES (32, 'computer science');
INSERT INTO minors (id, minor) VALUES (33, 'computing in the arts');
INSERT INTO minors (id, minor) VALUES (34, 'creative writing');
INSERT INTO minors (id, minor) VALUES (35, 'crime, prisons, education, and justice');
INSERT INTO minors (id, minor) VALUES (36, 'crop management');
INSERT INTO minors (id, minor) VALUES (37, 'dance');
INSERT INTO minors (id, minor) VALUES (38, 'demography');
INSERT INTO minors (id, minor) VALUES (39, 'design & environmental analysis');
INSERT INTO minors (id, minor) VALUES (40, 'development sociology');
INSERT INTO minors (id, minor) VALUES (41, 'earth and atmospheric sciences');
INSERT INTO minors (id, minor) VALUES (42, 'east asian studies');
INSERT INTO minors (id, minor) VALUES (43, 'english');
INSERT INTO minors (id, minor) VALUES (44, 'education');
INSERT INTO minors (id, minor) VALUES (45, 'electrical and computer engineering');
INSERT INTO minors (id, minor) VALUES (46, 'engineering entrepreneurship');
INSERT INTO minors (id, minor) VALUES (47, 'engineering management');
INSERT INTO minors (id, minor) VALUES (48, 'engineering statistics');
INSERT INTO minors (id, minor) VALUES (49, 'entomology');
INSERT INTO minors (id, minor) VALUES (50, 'environmental energy & resource economics');
INSERT INTO minors (id, minor) VALUES (51, 'environmental engineering');
INSERT INTO minors (id, minor) VALUES (52, 'environmental and sustainability sciences');
INSERT INTO minors (id, minor) VALUES (53, 'european studies');
INSERT INTO minors (id, minor) VALUES (54, 'feminist, gender & sexuality studies');
INSERT INTO minors (id, minor) VALUES (55, 'fiber science');
INSERT INTO minors (id, minor) VALUES (56, 'film');
INSERT INTO minors (id, minor) VALUES (57, 'fine arts');
INSERT INTO minors (id, minor) VALUES (58, 'food science');
INSERT INTO minors (id, minor) VALUES (59, 'french');
INSERT INTO minors (id, minor) VALUES (60, 'fungal biology');
INSERT INTO minors (id, minor) VALUES (61, 'game design');
INSERT INTO minors (id, minor) VALUES (62, 'german studies');
INSERT INTO minors (id, minor) VALUES (63, 'gerontology');
INSERT INTO minors (id, minor) VALUES (64, 'global health');
INSERT INTO minors (id, minor) VALUES (65, 'globalization, ethnicity & development');
INSERT INTO minors (id, minor) VALUES (66, 'health policy');
INSERT INTO minors (id, minor) VALUES (67, 'history');
INSERT INTO minors (id, minor) VALUES (68, 'history of art');
INSERT INTO minors (id, minor) VALUES (69, 'history of capitalism');
INSERT INTO minors (id, minor) VALUES (70, 'horticulture');
INSERT INTO minors (id, minor) VALUES (71, 'human development');
INSERT INTO minors (id, minor) VALUES (72, 'industrial systems & information technology');
INSERT INTO minors (id, minor) VALUES (73, 'inequality studies');
INSERT INTO minors (id, minor) VALUES (74, 'infectious disease biology');
INSERT INTO minors (id, minor) VALUES (75, 'information science');
INSERT INTO minors (id, minor) VALUES (76, 'international relations');
INSERT INTO minors (id, minor) VALUES (77, 'international development studies');
INSERT INTO minors (id, minor) VALUES (78, 'international trade & development');
INSERT INTO minors (id, minor) VALUES (79, 'italian studies');
INSERT INTO minors (id, minor) VALUES (80, 'jewish studies');
INSERT INTO minors (id, minor) VALUES (81, 'landscape studies');
INSERT INTO minors (id, minor) VALUES (82, 'latin american studies');
INSERT INTO minors (id, minor) VALUES (83, 'latina/o studies');
INSERT INTO minors (id, minor) VALUES (84, 'law and regulation');
INSERT INTO minors (id, minor) VALUES (85, 'law and society');
INSERT INTO minors (id, minor) VALUES (86, 'leadership');
INSERT INTO minors (id, minor) VALUES (87, 'lesbian, gay, bisexual & transgender studies');
INSERT INTO minors (id, minor) VALUES (88, 'linguistics');
INSERT INTO minors (id, minor) VALUES (89, 'marine biology');
INSERT INTO minors (id, minor) VALUES (90, 'materials science and engineering');
INSERT INTO minors (id, minor) VALUES (91, 'mathematics');
INSERT INTO minors (id, minor) VALUES (92, 'mechanical engineering');
INSERT INTO minors (id, minor) VALUES (93, 'medieval studies');
INSERT INTO minors (id, minor) VALUES (94, 'minority, indigenous and third world studies');
INSERT INTO minors (id, minor) VALUES (95, 'music');
INSERT INTO minors (id, minor) VALUES (96, 'near eastern studies');
INSERT INTO minors (id, minor) VALUES (97, 'nutrition & health');
INSERT INTO minors (id, minor) VALUES (98, 'operations research & management science');
INSERT INTO minors (id, minor) VALUES (99, 'performing and media arts');
INSERT INTO minors (id, minor) VALUES (100, 'philosophy');
INSERT INTO minors (id, minor) VALUES (101, 'physics');
INSERT INTO minors (id, minor) VALUES (102, 'plant breeding');
INSERT INTO minors (id, minor) VALUES (103, 'plant sciences');
INSERT INTO minors (id, minor) VALUES (104, 'policy analysis and management');
INSERT INTO minors (id, minor) VALUES (105, 'portuguese and brazilian studies');
INSERT INTO minors (id, minor) VALUES (106, 'psychology');
INSERT INTO minors (id, minor) VALUES (107, 'public policy');
INSERT INTO minors (id, minor) VALUES (108, 'real estate');
INSERT INTO minors (id, minor) VALUES (109, 'religious studies');
INSERT INTO minors (id, minor) VALUES (110, 'robotics');
INSERT INTO minors (id, minor) VALUES (111, 'russian');
INSERT INTO minors (id, minor) VALUES (112, 'sanskrit studies');
INSERT INTO minors (id, minor) VALUES (113, 'science & technology studies');
INSERT INTO minors (id, minor) VALUES (114, 'soil science');
INSERT INTO minors (id, minor) VALUES (115, 'south asian studies');
INSERT INTO minors (id, minor) VALUES (116, 'southeast asian studies');
INSERT INTO minors (id, minor) VALUES (117, 'spanish');
INSERT INTO minors (id, minor) VALUES (118, 'sustainable energy systems');
INSERT INTO minors (id, minor) VALUES (119, 'theatre');
INSERT INTO minors (id, minor) VALUES (120, 'university-wide business minor');
INSERT INTO minors (id, minor) VALUES (121, 'urban and regional studies');
INSERT INTO minors (id, minor) VALUES (122, 'viking studies');
INSERT INTO minors (id, minor) VALUES (123, 'visual studies');
INSERT INTO minors (id, minor) VALUES (124, 'viticulture and enology');



--schools Table Seed data
INSERT INTO schools (id, school) VALUES (1, 'cals');
INSERT INTO schools (id, school) VALUES (2, 'caap');
INSERT INTO schools (id, school) VALUES (3, 'cas');
INSERT INTO schools (id, school) VALUES (4, 'sc');
INSERT INTO schools (id, school) VALUES (5, 'coe');
INSERT INTO schools (id, school) VALUES (6, 'humec');
INSERT INTO schools (id, school) VALUES (7, 'ilr');



--Tracks seed data
INSERT INTO tracks (id, track) VALUES (1, 'cpa');
INSERT INTO tracks (id, track) VALUES (2, 'grad school');
INSERT INTO tracks (id, track) VALUES (3, 'investment-banking');
INSERT INTO tracks (id, track) VALUES (4, 'pre-dental');
INSERT INTO tracks (id, track) VALUES (5, 'pre-law');
INSERT INTO tracks (id, track) VALUES (6, 'pre-med');
INSERT INTO tracks (id, track) VALUES (7, 'pre-vet');



--Comments seed data
INSERT INTO comments (id, comment) VALUES (1, 'Nice schedule! I like your choice of PE');
INSERT INTO comments (id, comment) VALUES (2, 'Your schedule is pretty packed. You can take some classes next semester and still graduate on time.');
INSERT INTO comments (id, comment) VALUES (3, 'I would make sure to have a lunch time. It can be hard to eat in class');




--seed data
INSERT INTO post_majors (id, post_id, major_id) VALUES (1, 1, 56);
INSERT INTO post_majors (id, post_id, major_id) VALUES (2, 1, 25);

INSERT INTO post_majors (id, post_id, major_id) VALUES (3, 2, 55);
INSERT INTO post_majors (id, post_id, major_id) VALUES (4, 3, 64);
INSERT INTO post_majors (id, post_id, major_id) VALUES (5, 4, 73);
INSERT INTO post_majors (id, post_id, major_id) VALUES (6, 5, 64);
INSERT INTO post_majors (id, post_id, major_id) VALUES (7, 6, 55);




--seed data
INSERT INTO post_minors (id, post_id, minor_id) VALUES (1, 2, 32);
INSERT INTO post_minors (id, post_id, minor_id) VALUES (2, 6, 32);




--Seed data
INSERT INTO post_tracks (id, post_id, track_id) VALUES (1, 4, 5);



--seed data
INSERT INTO post_comments (id, post_id, comment_id) VALUES (1, 1, 1);
INSERT INTO post_comments (id, post_id, comment_id) VALUES (2, 2, 2);
INSERT INTO post_comments (id, post_id, comment_id) VALUES (3, 2, 3);

​

COMMIT;





