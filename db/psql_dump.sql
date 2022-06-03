--
-- PostgreSQL database dump
--

-- Dumped from database version 14.3
-- Dumped by pg_dump version 14.3

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: categoria; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.categoria (
    id integer NOT NULL,
    nombre character varying(64) NOT NULL
);


ALTER TABLE public.categoria OWNER TO pf;

--
-- Name: categoria_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.categoria_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categoria_id_seq OWNER TO pf;

--
-- Name: categoria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.categoria_id_seq OWNED BY public.categoria.id;


--
-- Name: color; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.color (
    id integer NOT NULL,
    nombre character varying(24) NOT NULL
);


ALTER TABLE public.color OWNER TO pf;

--
-- Name: color_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.color_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.color_id_seq OWNER TO pf;

--
-- Name: color_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.color_id_seq OWNED BY public.color.id;


--
-- Name: color_tono; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.color_tono (
    id integer NOT NULL,
    id_color integer NOT NULL,
    id_tono integer NOT NULL
);


ALTER TABLE public.color_tono OWNER TO pf;

--
-- Name: color_tono_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.color_tono_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.color_tono_id_seq OWNER TO pf;

--
-- Name: color_tono_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.color_tono_id_seq OWNED BY public.color_tono.id;


--
-- Name: especificacion; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.especificacion (
    id integer NOT NULL,
    id_producto integer NOT NULL,
    id_marca integer NOT NULL,
    id_temporada integer,
    id_categoria integer NOT NULL,
    id_genero integer NOT NULL,
    id_color_tono integer NOT NULL,
    id_talla_etapa integer NOT NULL,
    descripcion character varying(1024) DEFAULT NULL::character varying
);


ALTER TABLE public.especificacion OWNER TO pf;

--
-- Name: especificacion_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.especificacion_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.especificacion_id_seq OWNER TO pf;

--
-- Name: especificacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.especificacion_id_seq OWNED BY public.especificacion.id;


--
-- Name: especificacion_tipo; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.especificacion_tipo (
    id integer NOT NULL,
    id_especificacion integer NOT NULL,
    id_tipo integer NOT NULL
);


ALTER TABLE public.especificacion_tipo OWNER TO pf;

--
-- Name: especificacion_tipo_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.especificacion_tipo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.especificacion_tipo_id_seq OWNER TO pf;

--
-- Name: especificacion_tipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.especificacion_tipo_id_seq OWNED BY public.especificacion_tipo.id;


--
-- Name: estado; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.estado (
    id integer NOT NULL,
    nombre character varying(16) NOT NULL
);


ALTER TABLE public.estado OWNER TO pf;

--
-- Name: estado_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.estado_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estado_id_seq OWNER TO pf;

--
-- Name: estado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.estado_id_seq OWNED BY public.estado.id;


--
-- Name: etapa; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.etapa (
    id integer NOT NULL,
    nombre character varying(64) NOT NULL
);


ALTER TABLE public.etapa OWNER TO pf;

--
-- Name: etapa_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.etapa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.etapa_id_seq OWNER TO pf;

--
-- Name: etapa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.etapa_id_seq OWNED BY public.etapa.id;


--
-- Name: genero; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.genero (
    id integer NOT NULL,
    nombre character varying(128) NOT NULL
);


ALTER TABLE public.genero OWNER TO pf;

--
-- Name: genero_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.genero_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.genero_id_seq OWNER TO pf;

--
-- Name: genero_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.genero_id_seq OWNED BY public.genero.id;


--
-- Name: historial_precio; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.historial_precio (
    id integer NOT NULL,
    id_inventario integer NOT NULL,
    fecha date DEFAULT now() NOT NULL,
    precio numeric(2,0) NOT NULL
);


ALTER TABLE public.historial_precio OWNER TO pf;

--
-- Name: historial_precio_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.historial_precio_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.historial_precio_id_seq OWNER TO pf;

--
-- Name: historial_precio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.historial_precio_id_seq OWNED BY public.historial_precio.id;


--
-- Name: inventario; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.inventario (
    id integer NOT NULL,
    id_especificacion integer NOT NULL,
    id_talla integer NOT NULL,
    id_estado integer NOT NULL,
    cantidad integer NOT NULL,
    precio numeric(2,0) NOT NULL,
    fecha_ingreso date DEFAULT now() NOT NULL
);


ALTER TABLE public.inventario OWNER TO pf;

--
-- Name: inventario_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.inventario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inventario_id_seq OWNER TO pf;

--
-- Name: inventario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.inventario_id_seq OWNED BY public.inventario.id;


--
-- Name: marca; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.marca (
    id integer NOT NULL,
    nombre character varying(128) NOT NULL
);


ALTER TABLE public.marca OWNER TO pf;

--
-- Name: marca_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.marca_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.marca_id_seq OWNER TO pf;

--
-- Name: marca_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.marca_id_seq OWNED BY public.marca.id;


--
-- Name: producto; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.producto (
    id integer NOT NULL,
    nombre character varying(255) NOT NULL
);


ALTER TABLE public.producto OWNER TO pf;

--
-- Name: producto_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.producto_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.producto_id_seq OWNER TO pf;

--
-- Name: producto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.producto_id_seq OWNED BY public.producto.id;


--
-- Name: talla; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.talla (
    id integer NOT NULL,
    nombre character varying(24) NOT NULL
);


ALTER TABLE public.talla OWNER TO pf;

--
-- Name: talla_etapa; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.talla_etapa (
    id integer NOT NULL,
    id_talla integer NOT NULL,
    id_etapa integer NOT NULL
);


ALTER TABLE public.talla_etapa OWNER TO pf;

--
-- Name: talla_etapa_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.talla_etapa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.talla_etapa_id_seq OWNER TO pf;

--
-- Name: talla_etapa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.talla_etapa_id_seq OWNED BY public.talla_etapa.id;


--
-- Name: talla_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.talla_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.talla_id_seq OWNER TO pf;

--
-- Name: talla_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.talla_id_seq OWNED BY public.talla.id;


--
-- Name: temporada; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.temporada (
    id integer NOT NULL,
    nombre character varying(24) NOT NULL
);


ALTER TABLE public.temporada OWNER TO pf;

--
-- Name: temporada_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.temporada_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.temporada_id_seq OWNER TO pf;

--
-- Name: temporada_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.temporada_id_seq OWNED BY public.temporada.id;


--
-- Name: tipo; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.tipo (
    id integer NOT NULL,
    nombre character varying(64) NOT NULL
);


ALTER TABLE public.tipo OWNER TO pf;

--
-- Name: tipo_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.tipo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_id_seq OWNER TO pf;

--
-- Name: tipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.tipo_id_seq OWNED BY public.tipo.id;


--
-- Name: tipo_transaccion; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.tipo_transaccion (
    id integer NOT NULL,
    nombre character varying(64) NOT NULL
);


ALTER TABLE public.tipo_transaccion OWNER TO pf;

--
-- Name: tipo_transaccion_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.tipo_transaccion_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_transaccion_id_seq OWNER TO pf;

--
-- Name: tipo_transaccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.tipo_transaccion_id_seq OWNED BY public.tipo_transaccion.id;


--
-- Name: tono; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.tono (
    id integer NOT NULL,
    nombre character varying(24) NOT NULL
);


ALTER TABLE public.tono OWNER TO pf;

--
-- Name: tono_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.tono_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tono_id_seq OWNER TO pf;

--
-- Name: tono_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.tono_id_seq OWNED BY public.tono.id;


--
-- Name: transaccion; Type: TABLE; Schema: public; Owner: pf
--

CREATE TABLE public.transaccion (
    id integer NOT NULL,
    id_tipo_transaccion integer,
    id_inventario integer,
    fecha date DEFAULT now() NOT NULL
);


ALTER TABLE public.transaccion OWNER TO pf;

--
-- Name: transaccion_id_seq; Type: SEQUENCE; Schema: public; Owner: pf
--

CREATE SEQUENCE public.transaccion_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.transaccion_id_seq OWNER TO pf;

--
-- Name: transaccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pf
--

ALTER SEQUENCE public.transaccion_id_seq OWNED BY public.transaccion.id;


--
-- Name: categoria id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.categoria ALTER COLUMN id SET DEFAULT nextval('public.categoria_id_seq'::regclass);


--
-- Name: color id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.color ALTER COLUMN id SET DEFAULT nextval('public.color_id_seq'::regclass);


--
-- Name: color_tono id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.color_tono ALTER COLUMN id SET DEFAULT nextval('public.color_tono_id_seq'::regclass);


--
-- Name: especificacion id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion ALTER COLUMN id SET DEFAULT nextval('public.especificacion_id_seq'::regclass);


--
-- Name: especificacion_tipo id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion_tipo ALTER COLUMN id SET DEFAULT nextval('public.especificacion_tipo_id_seq'::regclass);


--
-- Name: estado id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.estado ALTER COLUMN id SET DEFAULT nextval('public.estado_id_seq'::regclass);


--
-- Name: etapa id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.etapa ALTER COLUMN id SET DEFAULT nextval('public.etapa_id_seq'::regclass);


--
-- Name: genero id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.genero ALTER COLUMN id SET DEFAULT nextval('public.genero_id_seq'::regclass);


--
-- Name: historial_precio id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.historial_precio ALTER COLUMN id SET DEFAULT nextval('public.historial_precio_id_seq'::regclass);


--
-- Name: inventario id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.inventario ALTER COLUMN id SET DEFAULT nextval('public.inventario_id_seq'::regclass);


--
-- Name: marca id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.marca ALTER COLUMN id SET DEFAULT nextval('public.marca_id_seq'::regclass);


--
-- Name: producto id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.producto ALTER COLUMN id SET DEFAULT nextval('public.producto_id_seq'::regclass);


--
-- Name: talla id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.talla ALTER COLUMN id SET DEFAULT nextval('public.talla_id_seq'::regclass);


--
-- Name: talla_etapa id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.talla_etapa ALTER COLUMN id SET DEFAULT nextval('public.talla_etapa_id_seq'::regclass);


--
-- Name: temporada id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.temporada ALTER COLUMN id SET DEFAULT nextval('public.temporada_id_seq'::regclass);


--
-- Name: tipo id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tipo ALTER COLUMN id SET DEFAULT nextval('public.tipo_id_seq'::regclass);


--
-- Name: tipo_transaccion id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tipo_transaccion ALTER COLUMN id SET DEFAULT nextval('public.tipo_transaccion_id_seq'::regclass);


--
-- Name: tono id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tono ALTER COLUMN id SET DEFAULT nextval('public.tono_id_seq'::regclass);


--
-- Name: transaccion id; Type: DEFAULT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.transaccion ALTER COLUMN id SET DEFAULT nextval('public.transaccion_id_seq'::regclass);


--
-- Data for Name: categoria; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.categoria (id, nombre) FROM stdin;
\.


--
-- Data for Name: color; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.color (id, nombre) FROM stdin;
\.


--
-- Data for Name: color_tono; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.color_tono (id, id_color, id_tono) FROM stdin;
\.


--
-- Data for Name: especificacion; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.especificacion (id, id_producto, id_marca, id_temporada, id_categoria, id_genero, id_color_tono, id_talla_etapa, descripcion) FROM stdin;
\.


--
-- Data for Name: especificacion_tipo; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.especificacion_tipo (id, id_especificacion, id_tipo) FROM stdin;
\.


--
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.estado (id, nombre) FROM stdin;
\.


--
-- Data for Name: etapa; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.etapa (id, nombre) FROM stdin;
\.


--
-- Data for Name: genero; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.genero (id, nombre) FROM stdin;
\.


--
-- Data for Name: historial_precio; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.historial_precio (id, id_inventario, fecha, precio) FROM stdin;
\.


--
-- Data for Name: inventario; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.inventario (id, id_especificacion, id_talla, id_estado, cantidad, precio, fecha_ingreso) FROM stdin;
\.


--
-- Data for Name: marca; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.marca (id, nombre) FROM stdin;
\.


--
-- Data for Name: producto; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.producto (id, nombre) FROM stdin;
\.


--
-- Data for Name: talla; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.talla (id, nombre) FROM stdin;
\.


--
-- Data for Name: talla_etapa; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.talla_etapa (id, id_talla, id_etapa) FROM stdin;
\.


--
-- Data for Name: temporada; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.temporada (id, nombre) FROM stdin;
\.


--
-- Data for Name: tipo; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.tipo (id, nombre) FROM stdin;
\.


--
-- Data for Name: tipo_transaccion; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.tipo_transaccion (id, nombre) FROM stdin;
\.


--
-- Data for Name: tono; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.tono (id, nombre) FROM stdin;
\.


--
-- Data for Name: transaccion; Type: TABLE DATA; Schema: public; Owner: pf
--

COPY public.transaccion (id, id_tipo_transaccion, id_inventario, fecha) FROM stdin;
\.


--
-- Name: categoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.categoria_id_seq', 1, false);


--
-- Name: color_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.color_id_seq', 1, false);


--
-- Name: color_tono_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.color_tono_id_seq', 1, false);


--
-- Name: especificacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.especificacion_id_seq', 1, false);


--
-- Name: especificacion_tipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.especificacion_tipo_id_seq', 1, false);


--
-- Name: estado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.estado_id_seq', 1, false);


--
-- Name: etapa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.etapa_id_seq', 1, false);


--
-- Name: genero_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.genero_id_seq', 1, false);


--
-- Name: historial_precio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.historial_precio_id_seq', 1, false);


--
-- Name: inventario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.inventario_id_seq', 1, false);


--
-- Name: marca_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.marca_id_seq', 1, false);


--
-- Name: producto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.producto_id_seq', 1, false);


--
-- Name: talla_etapa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.talla_etapa_id_seq', 1, false);


--
-- Name: talla_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.talla_id_seq', 1, false);


--
-- Name: temporada_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.temporada_id_seq', 1, false);


--
-- Name: tipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.tipo_id_seq', 1, false);


--
-- Name: tipo_transaccion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.tipo_transaccion_id_seq', 1, false);


--
-- Name: tono_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.tono_id_seq', 1, false);


--
-- Name: transaccion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: pf
--

SELECT pg_catalog.setval('public.transaccion_id_seq', 1, false);


--
-- Name: categoria categoria_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_nombre_key UNIQUE (nombre);


--
-- Name: categoria categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (id);


--
-- Name: color color_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.color
    ADD CONSTRAINT color_nombre_key UNIQUE (nombre);


--
-- Name: color color_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.color
    ADD CONSTRAINT color_pkey PRIMARY KEY (id);


--
-- Name: color_tono color_tono_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.color_tono
    ADD CONSTRAINT color_tono_pkey PRIMARY KEY (id);


--
-- Name: especificacion especificacion_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion
    ADD CONSTRAINT especificacion_pkey PRIMARY KEY (id);


--
-- Name: especificacion_tipo especificacion_tipo_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion_tipo
    ADD CONSTRAINT especificacion_tipo_pkey PRIMARY KEY (id);


--
-- Name: estado estado_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.estado
    ADD CONSTRAINT estado_nombre_key UNIQUE (nombre);


--
-- Name: estado estado_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.estado
    ADD CONSTRAINT estado_pkey PRIMARY KEY (id);


--
-- Name: etapa etapa_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.etapa
    ADD CONSTRAINT etapa_nombre_key UNIQUE (nombre);


--
-- Name: etapa etapa_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.etapa
    ADD CONSTRAINT etapa_pkey PRIMARY KEY (id);


--
-- Name: genero genero_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.genero
    ADD CONSTRAINT genero_nombre_key UNIQUE (nombre);


--
-- Name: genero genero_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.genero
    ADD CONSTRAINT genero_pkey PRIMARY KEY (id);


--
-- Name: historial_precio historial_precio_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.historial_precio
    ADD CONSTRAINT historial_precio_pkey PRIMARY KEY (id);


--
-- Name: inventario inventario_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_pkey PRIMARY KEY (id);


--
-- Name: marca marca_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.marca
    ADD CONSTRAINT marca_nombre_key UNIQUE (nombre);


--
-- Name: marca marca_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.marca
    ADD CONSTRAINT marca_pkey PRIMARY KEY (id);


--
-- Name: producto producto_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_nombre_key UNIQUE (nombre);


--
-- Name: producto producto_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_pkey PRIMARY KEY (id);


--
-- Name: talla_etapa talla_etapa_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.talla_etapa
    ADD CONSTRAINT talla_etapa_pkey PRIMARY KEY (id);


--
-- Name: talla talla_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.talla
    ADD CONSTRAINT talla_nombre_key UNIQUE (nombre);


--
-- Name: talla talla_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.talla
    ADD CONSTRAINT talla_pkey PRIMARY KEY (id);


--
-- Name: temporada temporada_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.temporada
    ADD CONSTRAINT temporada_nombre_key UNIQUE (nombre);


--
-- Name: temporada temporada_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.temporada
    ADD CONSTRAINT temporada_pkey PRIMARY KEY (id);


--
-- Name: tipo tipo_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tipo
    ADD CONSTRAINT tipo_nombre_key UNIQUE (nombre);


--
-- Name: tipo tipo_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tipo
    ADD CONSTRAINT tipo_pkey PRIMARY KEY (id);


--
-- Name: tipo_transaccion tipo_transaccion_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tipo_transaccion
    ADD CONSTRAINT tipo_transaccion_nombre_key UNIQUE (nombre);


--
-- Name: tipo_transaccion tipo_transaccion_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tipo_transaccion
    ADD CONSTRAINT tipo_transaccion_pkey PRIMARY KEY (id);


--
-- Name: tono tono_nombre_key; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tono
    ADD CONSTRAINT tono_nombre_key UNIQUE (nombre);


--
-- Name: tono tono_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.tono
    ADD CONSTRAINT tono_pkey PRIMARY KEY (id);


--
-- Name: transaccion transaccion_pkey; Type: CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.transaccion
    ADD CONSTRAINT transaccion_pkey PRIMARY KEY (id);


--
-- Name: color_tono color_tono_id_color_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.color_tono
    ADD CONSTRAINT color_tono_id_color_fkey FOREIGN KEY (id_color) REFERENCES public.color(id);


--
-- Name: color_tono color_tono_id_tono_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.color_tono
    ADD CONSTRAINT color_tono_id_tono_fkey FOREIGN KEY (id_tono) REFERENCES public.tono(id);


--
-- Name: especificacion especificacion_id_categoria_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion
    ADD CONSTRAINT especificacion_id_categoria_fkey FOREIGN KEY (id_categoria) REFERENCES public.categoria(id);


--
-- Name: especificacion especificacion_id_color_tono_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion
    ADD CONSTRAINT especificacion_id_color_tono_fkey FOREIGN KEY (id_color_tono) REFERENCES public.color_tono(id);


--
-- Name: especificacion especificacion_id_genero_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion
    ADD CONSTRAINT especificacion_id_genero_fkey FOREIGN KEY (id_genero) REFERENCES public.genero(id);


--
-- Name: especificacion especificacion_id_marca_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion
    ADD CONSTRAINT especificacion_id_marca_fkey FOREIGN KEY (id_marca) REFERENCES public.marca(id);


--
-- Name: especificacion especificacion_id_producto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion
    ADD CONSTRAINT especificacion_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES public.producto(id);


--
-- Name: especificacion especificacion_id_talla_etapa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion
    ADD CONSTRAINT especificacion_id_talla_etapa_fkey FOREIGN KEY (id_talla_etapa) REFERENCES public.talla_etapa(id);


--
-- Name: especificacion especificacion_id_temporada_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion
    ADD CONSTRAINT especificacion_id_temporada_fkey FOREIGN KEY (id_temporada) REFERENCES public.temporada(id);


--
-- Name: especificacion_tipo especificacion_tipo_id_especificacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion_tipo
    ADD CONSTRAINT especificacion_tipo_id_especificacion_fkey FOREIGN KEY (id_especificacion) REFERENCES public.especificacion(id);


--
-- Name: especificacion_tipo especificacion_tipo_id_tipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.especificacion_tipo
    ADD CONSTRAINT especificacion_tipo_id_tipo_fkey FOREIGN KEY (id_tipo) REFERENCES public.tipo(id);


--
-- Name: historial_precio historial_precio_id_inventario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.historial_precio
    ADD CONSTRAINT historial_precio_id_inventario_fkey FOREIGN KEY (id_inventario) REFERENCES public.inventario(id);


--
-- Name: inventario inventario_id_especificacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_especificacion_fkey FOREIGN KEY (id_especificacion) REFERENCES public.especificacion(id);


--
-- Name: inventario inventario_id_estado_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES public.estado(id);


--
-- Name: inventario inventario_id_talla_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.inventario
    ADD CONSTRAINT inventario_id_talla_fkey FOREIGN KEY (id_talla) REFERENCES public.talla(id);


--
-- Name: talla_etapa talla_etapa_id_etapa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.talla_etapa
    ADD CONSTRAINT talla_etapa_id_etapa_fkey FOREIGN KEY (id_etapa) REFERENCES public.etapa(id);


--
-- Name: talla_etapa talla_etapa_id_talla_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.talla_etapa
    ADD CONSTRAINT talla_etapa_id_talla_fkey FOREIGN KEY (id_talla) REFERENCES public.talla(id);


--
-- Name: transaccion transaccion_id_inventario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.transaccion
    ADD CONSTRAINT transaccion_id_inventario_fkey FOREIGN KEY (id_inventario) REFERENCES public.inventario(id);


--
-- Name: transaccion transaccion_id_tipo_transaccion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: pf
--

ALTER TABLE ONLY public.transaccion
    ADD CONSTRAINT transaccion_id_tipo_transaccion_fkey FOREIGN KEY (id_tipo_transaccion) REFERENCES public.tipo_transaccion(id);


--
-- PostgreSQL database dump complete
--

