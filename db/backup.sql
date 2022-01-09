--
-- PostgreSQL database dump
--

-- Dumped from database version 12.9 (Debian 12.9-1.pgdg110+1)
-- Dumped by pg_dump version 12.9 (Debian 12.9-1.pgdg110+1)

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
-- Name: notify_messenger_messages(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.notify_messenger_messages() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
            BEGIN
                PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$;


ALTER FUNCTION public.notify_messenger_messages() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: basket; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.basket (
    id integer NOT NULL,
    quantity integer NOT NULL,
    price_one integer NOT NULL,
    price_total integer NOT NULL,
    product_id_id integer,
    order_id_id integer
);


ALTER TABLE public.basket OWNER TO postgres;

--
-- Name: basket_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.basket_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.basket_id_seq OWNER TO postgres;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO postgres;

--
-- Name: messenger_messages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.messenger_messages (
    id bigint NOT NULL,
    body text NOT NULL,
    headers text NOT NULL,
    queue_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    available_at timestamp(0) without time zone NOT NULL,
    delivered_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


ALTER TABLE public.messenger_messages OWNER TO postgres;

--
-- Name: messenger_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.messenger_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.messenger_messages_id_seq OWNER TO postgres;

--
-- Name: messenger_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.messenger_messages_id_seq OWNED BY public.messenger_messages.id;


--
-- Name: order; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."order" (
    id integer NOT NULL,
    client_name character varying(255) NOT NULL,
    client_phone character varying(255) NOT NULL,
    is_pay boolean NOT NULL
);


ALTER TABLE public."order" OWNER TO postgres;

--
-- Name: order_basket; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.order_basket (
    order_id integer NOT NULL,
    basket_id integer NOT NULL
);


ALTER TABLE public.order_basket OWNER TO postgres;

--
-- Name: order_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.order_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_id_seq OWNER TO postgres;

--
-- Name: product; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description character varying(1000) DEFAULT NULL::character varying,
    is_show boolean NOT NULL,
    price integer,
    basket_id integer,
    image character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.product OWNER TO postgres;

--
-- Name: product_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_id_seq OWNER TO postgres;

--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    email character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Name: messenger_messages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messenger_messages ALTER COLUMN id SET DEFAULT nextval('public.messenger_messages_id_seq'::regclass);


--
-- Data for Name: basket; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.basket (id, quantity, price_one, price_total, product_id_id, order_id_id) FROM stdin;
80	1	520	520	4	\N
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20211219152814	2021-12-19 15:28:48	85
DoctrineMigrations\\Version20211219210920	2021-12-19 21:09:40	73
DoctrineMigrations\\Version20211221104634	2021-12-21 10:59:55	58
DoctrineMigrations\\Version20211221110133	2021-12-21 11:01:41	36
DoctrineMigrations\\Version20211222122412	2022-01-02 18:17:05	140
DoctrineMigrations\\Version20220102181653	2022-01-02 18:17:05	9
DoctrineMigrations\\Version20220102190740	2022-01-02 19:08:01	75
DoctrineMigrations\\Version20220104200748	2022-01-04 20:09:19	67
DoctrineMigrations\\Version20220109093757	2022-01-09 10:19:43	94
DoctrineMigrations\\Version20220109102805	2022-01-09 10:28:50	41
\.


--
-- Data for Name: messenger_messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) FROM stdin;
\.


--
-- Data for Name: order; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."order" (id, client_name, client_phone, is_pay) FROM stdin;
59	nikokay	9222671646	t
\.


--
-- Data for Name: order_basket; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.order_basket (order_id, basket_id) FROM stdin;
59	80
\.


--
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product (id, name, description, is_show, price, basket_id, image) FROM stdin;
4	Ягодица	32 см, Пикантный томатный соус, сыр, салями, колбаски охотничьи, огурцы маринованные, лук репчатый, сушеный базилик	t	520	\N	img/pizza_1.jpg
6	Кузьмич	32 см, Томат, зелень, два вида колбасы, маринованные огурцы, сыр, пышное тесто, чесночночный соус	t	269	\N	img/pizza_3.jpg
5	Деревенская	32 см, Пикантный томатный соус, копченая куриная грудинка, ветчина, томаты, маринованные огурчики, зелень, сыр, пышное тесто	t	350	\N	img/pizza_2.jpg
7	Моцарелла	32 см, Пикантный томатный соус, сыр, салями, колбаски охотничьи, огурцы маринованные, лук репчатый, сушеный базилик	t	404	\N	img/pizza_4.jpg
8	Ассорти	32 см, Томат, зелень, два вида колбасы, маринованные огурцы, сыр, пышное тесто, чесночночный соус.	t	590	\N	img/pizza_6.jpg
9	С мятой	32 см, Томат, зелень, два вида колбасы, маринованные огурцы, сыр, пышное тесто, чесночночный соус	t	330	\N	img/pizza_5.jpg
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, email, roles, password) FROM stdin;
22	user@user.ru	[]	$2y$13$cc/23EHghF/R1Awsb7ZEMOOLqgkEeDrgBxWDSNwYWiNW/6LR7VLE.
23	admin@admin.ru	["ROLE_USER","ROLE_ADMIN"]	$2y$13$I2IaO0.UOPYSiUVrfdm62OKzLhOPrXEI4cby/y8VaSpRwXG1UeDVC
\.


--
-- Name: basket_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.basket_id_seq', 80, true);


--
-- Name: messenger_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.messenger_messages_id_seq', 1, false);


--
-- Name: order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.order_id_seq', 59, true);


--
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_id_seq', 9, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 23, true);


--
-- Name: basket basket_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.basket
    ADD CONSTRAINT basket_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: messenger_messages messenger_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messenger_messages
    ADD CONSTRAINT messenger_messages_pkey PRIMARY KEY (id);


--
-- Name: order_basket order_basket_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.order_basket
    ADD CONSTRAINT order_basket_pkey PRIMARY KEY (order_id, basket_id);


--
-- Name: order order_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."order"
    ADD CONSTRAINT order_pkey PRIMARY KEY (id);


--
-- Name: product product_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: idx_2246507bde18e50b; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_2246507bde18e50b ON public.basket USING btree (product_id_id);


--
-- Name: idx_2246507bfcdaeaaa; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_2246507bfcdaeaaa ON public.basket USING btree (order_id_id);


--
-- Name: idx_75ea56e016ba31db; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_75ea56e016ba31db ON public.messenger_messages USING btree (delivered_at);


--
-- Name: idx_75ea56e0e3bd61ce; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_75ea56e0e3bd61ce ON public.messenger_messages USING btree (available_at);


--
-- Name: idx_75ea56e0fb7336f0; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_75ea56e0fb7336f0 ON public.messenger_messages USING btree (queue_name);


--
-- Name: idx_d34a04ad1be1fb52; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_d34a04ad1be1fb52 ON public.product USING btree (basket_id);


--
-- Name: idx_e1c940ae1be1fb52; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_e1c940ae1be1fb52 ON public.order_basket USING btree (basket_id);


--
-- Name: idx_e1c940ae8d9f6d38; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_e1c940ae8d9f6d38 ON public.order_basket USING btree (order_id);


--
-- Name: uniq_8d93d649e7927c74; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON public."user" USING btree (email);


--
-- Name: messenger_messages notify_trigger; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON public.messenger_messages FOR EACH ROW EXECUTE FUNCTION public.notify_messenger_messages();


--
-- Name: basket fk_2246507bde18e50b; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.basket
    ADD CONSTRAINT fk_2246507bde18e50b FOREIGN KEY (product_id_id) REFERENCES public.product(id);


--
-- Name: basket fk_2246507bfcdaeaaa; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.basket
    ADD CONSTRAINT fk_2246507bfcdaeaaa FOREIGN KEY (order_id_id) REFERENCES public."order"(id);


--
-- Name: product fk_d34a04ad1be1fb52; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product
    ADD CONSTRAINT fk_d34a04ad1be1fb52 FOREIGN KEY (basket_id) REFERENCES public.basket(id);


--
-- Name: order_basket fk_e1c940ae1be1fb52; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.order_basket
    ADD CONSTRAINT fk_e1c940ae1be1fb52 FOREIGN KEY (basket_id) REFERENCES public.basket(id) ON DELETE CASCADE;


--
-- Name: order_basket fk_e1c940ae8d9f6d38; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.order_basket
    ADD CONSTRAINT fk_e1c940ae8d9f6d38 FOREIGN KEY (order_id) REFERENCES public."order"(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

