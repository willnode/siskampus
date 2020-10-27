--
-- PostgreSQL database dump
--

-- Dumped from database version 13.0
-- Dumped by pg_dump version 13.0

-- Started on 2020-10-27 08:48:46

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: master; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA master;


ALTER SCHEMA master OWNER TO postgres;

--
-- TOC entry 3085 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA master; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA master IS 'standard public schema';


--
-- TOC entry 7 (class 2615 OID 16520)
-- Name: meeting; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA meeting;


ALTER SCHEMA meeting OWNER TO postgres;

--
-- TOC entry 4 (class 2615 OID 16452)
-- Name: research; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA research;


ALTER SCHEMA research OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 207 (class 1259 OID 16436)
-- Name: department; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.department (
    id character varying NOT NULL,
    data jsonb NOT NULL
);


ALTER TABLE master.department OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16428)
-- Name: expertise; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.expertise (
    id character varying NOT NULL,
    data jsonb NOT NULL
);


ALTER TABLE master.expertise OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 16444)
-- Name: faculty; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.faculty (
    id character varying NOT NULL,
    data jsonb NOT NULL
);


ALTER TABLE master.faculty OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16403)
-- Name: lecturer; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.lecturer (
    id character varying NOT NULL,
    data jsonb NOT NULL
);


ALTER TABLE master.lecturer OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 16500)
-- Name: operator; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.operator (
    id character varying NOT NULL,
    data jsonb NOT NULL
);


ALTER TABLE master.operator OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16412)
-- Name: program; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.program (
    id character varying NOT NULL,
    data jsonb NOT NULL
);


ALTER TABLE master.program OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 16532)
-- Name: room; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.room (
    id character varying NOT NULL,
    data jsonb NOT NULL
);


ALTER TABLE master.room OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 16475)
-- Name: site; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.site (
    id integer NOT NULL,
    data jsonb
);


ALTER TABLE master.site OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16481)
-- Name: site_id_seq; Type: SEQUENCE; Schema: master; Owner: postgres
--

CREATE SEQUENCE master.site_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE master.site_id_seq OWNER TO postgres;

--
-- TOC entry 3086 (class 0 OID 0)
-- Dependencies: 214
-- Name: site_id_seq; Type: SEQUENCE OWNED BY; Schema: master; Owner: postgres
--

ALTER SEQUENCE master.site_id_seq OWNED BY master.site.id;


--
-- TOC entry 202 (class 1259 OID 16395)
-- Name: student; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.student (
    id character varying NOT NULL,
    data jsonb NOT NULL
);


ALTER TABLE master.student OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16420)
-- Name: users; Type: TABLE; Schema: master; Owner: postgres
--

CREATE TABLE master.users (
    username character varying NOT NULL,
    password character varying,
    otp character varying,
    type character varying
);


ALTER TABLE master.users OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16523)
-- Name: minute; Type: TABLE; Schema: meeting; Owner: postgres
--

CREATE TABLE meeting.minute (
    id integer NOT NULL,
    department_id integer,
    title character varying,
    note character varying,
    documents character varying[],
    galleries character varying[],
    "time" timestamp without time zone,
    duration integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    room_id character varying,
    status character varying,
    participants jsonb,
    chairman jsonb,
    reporter jsonb
);


ALTER TABLE meeting.minute OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16521)
-- Name: meeting_id_seq; Type: SEQUENCE; Schema: meeting; Owner: postgres
--

CREATE SEQUENCE meeting.meeting_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE meeting.meeting_id_seq OWNER TO postgres;

--
-- TOC entry 3087 (class 0 OID 0)
-- Dependencies: 216
-- Name: meeting_id_seq; Type: SEQUENCE OWNED BY; Schema: meeting; Owner: postgres
--

ALTER SEQUENCE meeting.meeting_id_seq OWNED BY meeting.minute.id;


--
-- TOC entry 210 (class 1259 OID 16455)
-- Name: proposal; Type: TABLE; Schema: research; Owner: postgres
--

CREATE TABLE research.proposal (
    id integer NOT NULL,
    student_id character varying,
    lecturer_id character varying[],
    expertise_id character varying,
    title character varying,
    abstract character varying,
    status character varying,
    file character varying,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE research.proposal OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 16453)
-- Name: proposal_id_seq; Type: SEQUENCE; Schema: research; Owner: postgres
--

CREATE SEQUENCE research.proposal_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE research.proposal_id_seq OWNER TO postgres;

--
-- TOC entry 3088 (class 0 OID 0)
-- Dependencies: 209
-- Name: proposal_id_seq; Type: SEQUENCE OWNED BY; Schema: research; Owner: postgres
--

ALTER SEQUENCE research.proposal_id_seq OWNED BY research.proposal.id;


--
-- TOC entry 212 (class 1259 OID 16466)
-- Name: seminar; Type: TABLE; Schema: research; Owner: postgres
--

CREATE TABLE research.seminar (
    id integer NOT NULL,
    location character varying,
    start_at time without time zone,
    end_at time without time zone,
    status character varying,
    proposal_id integer
);


ALTER TABLE research.seminar OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 16464)
-- Name: seminar_id_seq; Type: SEQUENCE; Schema: research; Owner: postgres
--

CREATE SEQUENCE research.seminar_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE research.seminar_id_seq OWNER TO postgres;

--
-- TOC entry 3089 (class 0 OID 0)
-- Dependencies: 211
-- Name: seminar_id_seq; Type: SEQUENCE OWNED BY; Schema: research; Owner: postgres
--

ALTER SEQUENCE research.seminar_id_seq OWNED BY research.seminar.id;


--
-- TOC entry 2921 (class 2604 OID 16483)
-- Name: site id; Type: DEFAULT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.site ALTER COLUMN id SET DEFAULT nextval('master.site_id_seq'::regclass);


--
-- TOC entry 2922 (class 2604 OID 16526)
-- Name: minute id; Type: DEFAULT; Schema: meeting; Owner: postgres
--

ALTER TABLE ONLY meeting.minute ALTER COLUMN id SET DEFAULT nextval('meeting.meeting_id_seq'::regclass);


--
-- TOC entry 2919 (class 2604 OID 16458)
-- Name: proposal id; Type: DEFAULT; Schema: research; Owner: postgres
--

ALTER TABLE ONLY research.proposal ALTER COLUMN id SET DEFAULT nextval('research.proposal_id_seq'::regclass);


--
-- TOC entry 2920 (class 2604 OID 16469)
-- Name: seminar id; Type: DEFAULT; Schema: research; Owner: postgres
--

ALTER TABLE ONLY research.seminar ALTER COLUMN id SET DEFAULT nextval('research.seminar_id_seq'::regclass);


--
-- TOC entry 2935 (class 2606 OID 16443)
-- Name: department department_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.department
    ADD CONSTRAINT department_pkey PRIMARY KEY (id);


--
-- TOC entry 2933 (class 2606 OID 16435)
-- Name: expertise expertises_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.expertise
    ADD CONSTRAINT expertises_pkey PRIMARY KEY (id);


--
-- TOC entry 2937 (class 2606 OID 16451)
-- Name: faculty faculty_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.faculty
    ADD CONSTRAINT faculty_pkey PRIMARY KEY (id);


--
-- TOC entry 2927 (class 2606 OID 16410)
-- Name: lecturer lecturer_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.lecturer
    ADD CONSTRAINT lecturer_pkey PRIMARY KEY (id);


--
-- TOC entry 2945 (class 2606 OID 16507)
-- Name: operator operator_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.operator
    ADD CONSTRAINT operator_pkey PRIMARY KEY (id);


--
-- TOC entry 2929 (class 2606 OID 16419)
-- Name: program program_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.program
    ADD CONSTRAINT program_pkey PRIMARY KEY (id);


--
-- TOC entry 2949 (class 2606 OID 16539)
-- Name: room room_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.room
    ADD CONSTRAINT room_pkey PRIMARY KEY (id);


--
-- TOC entry 2943 (class 2606 OID 16491)
-- Name: site site_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.site
    ADD CONSTRAINT site_pkey PRIMARY KEY (id);


--
-- TOC entry 2925 (class 2606 OID 16402)
-- Name: student student_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.student
    ADD CONSTRAINT student_pkey PRIMARY KEY (id);


--
-- TOC entry 2931 (class 2606 OID 16427)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: master; Owner: postgres
--

ALTER TABLE ONLY master.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (username);


--
-- TOC entry 2947 (class 2606 OID 16531)
-- Name: minute meeting_pkey; Type: CONSTRAINT; Schema: meeting; Owner: postgres
--

ALTER TABLE ONLY meeting.minute
    ADD CONSTRAINT meeting_pkey PRIMARY KEY (id);


--
-- TOC entry 2939 (class 2606 OID 16463)
-- Name: proposal proposal_pkey; Type: CONSTRAINT; Schema: research; Owner: postgres
--

ALTER TABLE ONLY research.proposal
    ADD CONSTRAINT proposal_pkey PRIMARY KEY (id);


--
-- TOC entry 2941 (class 2606 OID 16474)
-- Name: seminar seminar_pkey; Type: CONSTRAINT; Schema: research; Owner: postgres
--

ALTER TABLE ONLY research.seminar
    ADD CONSTRAINT seminar_pkey PRIMARY KEY (id);


--
-- TOC entry 2923 (class 1259 OID 16411)
-- Name: student_expr_idx; Type: INDEX; Schema: master; Owner: postgres
--

CREATE INDEX student_expr_idx ON master.student USING btree (((data ->> 'program'::text)));


-- Completed on 2020-10-27 08:48:46

--
-- PostgreSQL database dump complete
--

