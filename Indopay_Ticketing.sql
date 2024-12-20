PGDMP  3                    |            Indopay_HRIS    17.0    17.0 j    `           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            a           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            b           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            c           1262    16392    Indopay_HRIS    DATABASE     �   CREATE DATABASE "Indopay_HRIS" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';
    DROP DATABASE "Indopay_HRIS";
                     postgres    false            �            1259    29279    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap r       postgres    false            �            1259    29839    city    TABLE     \   CREATE TABLE public.city (
    city_id integer NOT NULL,
    city character varying(100)
);
    DROP TABLE public.city;
       public         heap r       postgres    false            �            1259    29838    city_city_id_seq    SEQUENCE     �   CREATE SEQUENCE public.city_city_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.city_city_id_seq;
       public               postgres    false    239            d           0    0    city_city_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.city_city_id_seq OWNED BY public.city.city_id;
          public               postgres    false    238            �            1259    29656    employee    TABLE     "  CREATE TABLE public.employee (
    "NIP" character varying(20) NOT NULL,
    email character varying(255) NOT NULL,
    first_name character varying(100),
    last_name character varying(100),
    role integer,
    service_point integer,
    password character varying(100),
    created_by character varying(50) DEFAULT 'Admin'::character varying,
    insert_datetime timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    update_by character varying(50) DEFAULT 'Admin'::character varying,
    update_datetime timestamp without time zone
);
    DROP TABLE public.employee;
       public         heap r       postgres    false            �            1259    29655    employee_NIP_seq    SEQUENCE     �   CREATE SEQUENCE public."employee_NIP_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public."employee_NIP_seq";
       public               postgres    false    230            e           0    0    employee_NIP_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public."employee_NIP_seq" OWNED BY public.employee."NIP";
          public               postgres    false    229            �            1259    29637    kantor_wilayah    TABLE     s   CREATE TABLE public.kantor_wilayah (
    kanwil_id integer NOT NULL,
    kanwil character varying(150) NOT NULL
);
 "   DROP TABLE public.kantor_wilayah;
       public         heap r       postgres    false            �            1259    29636    kantor_wilayah_kanwil_id_seq    SEQUENCE     �   CREATE SEQUENCE public.kantor_wilayah_kanwil_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.kantor_wilayah_kanwil_id_seq;
       public               postgres    false    226            f           0    0    kantor_wilayah_kanwil_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.kantor_wilayah_kanwil_id_seq OWNED BY public.kantor_wilayah.kanwil_id;
          public               postgres    false    225            �            1259    29940 	   m_address    TABLE     _   CREATE TABLE public.m_address (
    id integer NOT NULL,
    address character varying(200)
);
    DROP TABLE public.m_address;
       public         heap r       postgres    false            �            1259    29882    merchant    TABLE     C  CREATE TABLE public.merchant (
    "MID" character varying(20) NOT NULL,
    "EDC" integer,
    merchant_name character varying(100),
    email character varying(100),
    "PIC" character varying(100),
    address_1 text,
    address_2 text,
    city integer,
    merchant_category_id integer,
    service_point integer
);
    DROP TABLE public.merchant;
       public         heap r       postgres    false            �            1259    29828    merchant_category    TABLE     �   CREATE TABLE public.merchant_category (
    merchant_category_id integer NOT NULL,
    merchant_category character varying(100)
);
 %   DROP TABLE public.merchant_category;
       public         heap r       postgres    false            �            1259    29608    merchant_otp    TABLE     �   CREATE TABLE public.merchant_otp (
    id integer NOT NULL,
    "MID" character(50) NOT NULL,
    otp character(10),
    issued_date timestamp without time zone,
    exp_date timestamp without time zone
);
     DROP TABLE public.merchant_otp;
       public         heap r       postgres    false            �            1259    29607    merchant_otp_new_id_seq    SEQUENCE     �   CREATE SEQUENCE public.merchant_otp_new_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.merchant_otp_new_id_seq;
       public               postgres    false    222            g           0    0    merchant_otp_new_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.merchant_otp_new_id_seq OWNED BY public.merchant_otp.id;
          public               postgres    false    221            �            1259    29913 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap r       postgres    false            �            1259    29912    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public               postgres    false    242            h           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public               postgres    false    241            �            1259    29624    role    TABLE     d   CREATE TABLE public.role (
    role_id integer NOT NULL,
    role character varying(50) NOT NULL
);
    DROP TABLE public.role;
       public         heap r       postgres    false            �            1259    29623    role_role_id_seq    SEQUENCE     �   CREATE SEQUENCE public.role_role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.role_role_id_seq;
       public               postgres    false    224            i           0    0    role_role_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.role_role_id_seq OWNED BY public.role.role_id;
          public               postgres    false    223            �            1259    29644    service_point    TABLE     �   CREATE TABLE public.service_point (
    service_point_id integer NOT NULL,
    service_point character varying(100) NOT NULL,
    kanwil integer
);
 !   DROP TABLE public.service_point;
       public         heap r       postgres    false            �            1259    29643 "   service_point_service_point_id_seq    SEQUENCE     �   CREATE SEQUENCE public.service_point_service_point_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.service_point_service_point_id_seq;
       public               postgres    false    228            j           0    0 "   service_point_service_point_id_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.service_point_service_point_id_seq OWNED BY public.service_point.service_point_id;
          public               postgres    false    227            �            1259    29923    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id integer,
    ip_address character varying(45),
    user_agent text,
    payload text,
    last_activity bigint
);
    DROP TABLE public.sessions;
       public         heap r       postgres    false            �            1259    29821    tiket_status_detail    TABLE     �   CREATE TABLE public.tiket_status_detail (
    id integer NOT NULL,
    "TID" character varying(50) NOT NULL,
    status_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
 '   DROP TABLE public.tiket_status_detail;
       public         heap r       postgres    false            �            1259    29820    ticket_status_detail_id_seq    SEQUENCE     �   CREATE SEQUENCE public.ticket_status_detail_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.ticket_status_detail_id_seq;
       public               postgres    false    236            k           0    0    ticket_status_detail_id_seq    SEQUENCE OWNED BY     Z   ALTER SEQUENCE public.ticket_status_detail_id_seq OWNED BY public.tiket_status_detail.id;
          public               postgres    false    235            �            1259    29761    tiket    TABLE     �  CREATE TABLE public.tiket (
    id integer NOT NULL,
    "TID" character varying(50),
    "MID" character varying(50),
    status_id integer DEFAULT 4,
    title character varying(250),
    note text,
    urgency_id integer,
    category_id integer,
    action integer,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    comment character varying(500) DEFAULT '-'::character varying
);
    DROP TABLE public.tiket;
       public         heap r       postgres    false            �            1259    29735    tiket_category    TABLE     v   CREATE TABLE public.tiket_category (
    category_id integer NOT NULL,
    category character varying(50) NOT NULL
);
 "   DROP TABLE public.tiket_category;
       public         heap r       postgres    false            �            1259    29734    tiket_category_category_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tiket_category_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.tiket_category_category_id_seq;
       public               postgres    false    232            l           0    0    tiket_category_category_id_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.tiket_category_category_id_seq OWNED BY public.tiket_category.category_id;
          public               postgres    false    231            �            1259    29760    tiket_duplicated_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tiket_duplicated_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tiket_duplicated_id_seq;
       public               postgres    false    234            m           0    0    tiket_duplicated_id_seq    SEQUENCE OWNED BY     H   ALTER SEQUENCE public.tiket_duplicated_id_seq OWNED BY public.tiket.id;
          public               postgres    false    233            �            1259    29166    tiket_status    TABLE     p   CREATE TABLE public.tiket_status (
    status_id integer NOT NULL,
    status character varying(45) NOT NULL
);
     DROP TABLE public.tiket_status;
       public         heap r       postgres    false            �            1259    29171    tiket_urgency    TABLE     �   CREATE TABLE public.tiket_urgency (
    urgency_id integer NOT NULL,
    urgency character varying(45) DEFAULT NULL::character varying
);
 !   DROP TABLE public.tiket_urgency;
       public         heap r       postgres    false            �            1259    29555    users    TABLE     [  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    role_id integer,
    CONSTRAINT users_id_check CHECK ((id > 0))
);
    DROP TABLE public.users;
       public         heap r       postgres    false            �           2604    29842    city city_id    DEFAULT     l   ALTER TABLE ONLY public.city ALTER COLUMN city_id SET DEFAULT nextval('public.city_city_id_seq'::regclass);
 ;   ALTER TABLE public.city ALTER COLUMN city_id DROP DEFAULT;
       public               postgres    false    239    238    239            w           2604    29930    employee NIP    DEFAULT     p   ALTER TABLE ONLY public.employee ALTER COLUMN "NIP" SET DEFAULT nextval('public."employee_NIP_seq"'::regclass);
 =   ALTER TABLE public.employee ALTER COLUMN "NIP" DROP DEFAULT;
       public               postgres    false    230    229    230            u           2604    29640    kantor_wilayah kanwil_id    DEFAULT     �   ALTER TABLE ONLY public.kantor_wilayah ALTER COLUMN kanwil_id SET DEFAULT nextval('public.kantor_wilayah_kanwil_id_seq'::regclass);
 G   ALTER TABLE public.kantor_wilayah ALTER COLUMN kanwil_id DROP DEFAULT;
       public               postgres    false    225    226    226            s           2604    29611    merchant_otp id    DEFAULT     v   ALTER TABLE ONLY public.merchant_otp ALTER COLUMN id SET DEFAULT nextval('public.merchant_otp_new_id_seq'::regclass);
 >   ALTER TABLE public.merchant_otp ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    221    222    222            �           2604    29916    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    242    241    242            t           2604    29627    role role_id    DEFAULT     l   ALTER TABLE ONLY public.role ALTER COLUMN role_id SET DEFAULT nextval('public.role_role_id_seq'::regclass);
 ;   ALTER TABLE public.role ALTER COLUMN role_id DROP DEFAULT;
       public               postgres    false    223    224    224            v           2604    29647    service_point service_point_id    DEFAULT     �   ALTER TABLE ONLY public.service_point ALTER COLUMN service_point_id SET DEFAULT nextval('public.service_point_service_point_id_seq'::regclass);
 M   ALTER TABLE public.service_point ALTER COLUMN service_point_id DROP DEFAULT;
       public               postgres    false    227    228    228            |           2604    29764    tiket id    DEFAULT     o   ALTER TABLE ONLY public.tiket ALTER COLUMN id SET DEFAULT nextval('public.tiket_duplicated_id_seq'::regclass);
 7   ALTER TABLE public.tiket ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    233    234    234            {           2604    29738    tiket_category category_id    DEFAULT     �   ALTER TABLE ONLY public.tiket_category ALTER COLUMN category_id SET DEFAULT nextval('public.tiket_category_category_id_seq'::regclass);
 I   ALTER TABLE public.tiket_category ALTER COLUMN category_id DROP DEFAULT;
       public               postgres    false    232    231    232                       2604    29824    tiket_status_detail id    DEFAULT     �   ALTER TABLE ONLY public.tiket_status_detail ALTER COLUMN id SET DEFAULT nextval('public.ticket_status_detail_id_seq'::regclass);
 E   ALTER TABLE public.tiket_status_detail ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    236    235    236            D          0    29279    cache 
   TABLE DATA           7   COPY public.cache (key, value, expiration) FROM stdin;
    public               postgres    false    219   1�       X          0    29839    city 
   TABLE DATA           -   COPY public.city (city_id, city) FROM stdin;
    public               postgres    false    239   i�       O          0    29656    employee 
   TABLE DATA           �   COPY public.employee ("NIP", email, first_name, last_name, role, service_point, password, created_by, insert_datetime, update_by, update_datetime) FROM stdin;
    public               postgres    false    230   ��       K          0    29637    kantor_wilayah 
   TABLE DATA           ;   COPY public.kantor_wilayah (kanwil_id, kanwil) FROM stdin;
    public               postgres    false    226   ʊ       ]          0    29940 	   m_address 
   TABLE DATA           0   COPY public.m_address (id, address) FROM stdin;
    public               postgres    false    244   �       Y          0    29882    merchant 
   TABLE DATA           �   COPY public.merchant ("MID", "EDC", merchant_name, email, "PIC", address_1, address_2, city, merchant_category_id, service_point) FROM stdin;
    public               postgres    false    240   ��       V          0    29828    merchant_category 
   TABLE DATA           T   COPY public.merchant_category (merchant_category_id, merchant_category) FROM stdin;
    public               postgres    false    237   �       G          0    29608    merchant_otp 
   TABLE DATA           M   COPY public.merchant_otp (id, "MID", otp, issued_date, exp_date) FROM stdin;
    public               postgres    false    222   x�       [          0    29913 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public               postgres    false    242   �       I          0    29624    role 
   TABLE DATA           -   COPY public.role (role_id, role) FROM stdin;
    public               postgres    false    224   �       M          0    29644    service_point 
   TABLE DATA           P   COPY public.service_point (service_point_id, service_point, kanwil) FROM stdin;
    public               postgres    false    228   N�       \          0    29923    sessions 
   TABLE DATA           _   COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
    public               postgres    false    243   b�       S          0    29761    tiket 
   TABLE DATA           �   COPY public.tiket (id, "TID", "MID", status_id, title, note, urgency_id, category_id, action, created_at, updated_at, comment) FROM stdin;
    public               postgres    false    234   ��       Q          0    29735    tiket_category 
   TABLE DATA           ?   COPY public.tiket_category (category_id, category) FROM stdin;
    public               postgres    false    232   ŝ       B          0    29166    tiket_status 
   TABLE DATA           9   COPY public.tiket_status (status_id, status) FROM stdin;
    public               postgres    false    217   8�       U          0    29821    tiket_status_detail 
   TABLE DATA           O   COPY public.tiket_status_detail (id, "TID", status_id, created_at) FROM stdin;
    public               postgres    false    236   ��       C          0    29171    tiket_urgency 
   TABLE DATA           <   COPY public.tiket_urgency (urgency_id, urgency) FROM stdin;
    public               postgres    false    218   ��       E          0    29555    users 
   TABLE DATA           ~   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role_id) FROM stdin;
    public               postgres    false    220   ߣ       n           0    0    city_city_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.city_city_id_seq', 51, true);
          public               postgres    false    238            o           0    0    employee_NIP_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public."employee_NIP_seq"', 1, false);
          public               postgres    false    229            p           0    0    kantor_wilayah_kanwil_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.kantor_wilayah_kanwil_id_seq', 8, true);
          public               postgres    false    225            q           0    0    merchant_otp_new_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.merchant_otp_new_id_seq', 95, true);
          public               postgres    false    221            r           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 1, false);
          public               postgres    false    241            s           0    0    role_role_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.role_role_id_seq', 3, true);
          public               postgres    false    223            t           0    0 "   service_point_service_point_id_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.service_point_service_point_id_seq', 27, true);
          public               postgres    false    227            u           0    0    ticket_status_detail_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.ticket_status_detail_id_seq', 168, true);
          public               postgres    false    235            v           0    0    tiket_category_category_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.tiket_category_category_id_seq', 7, true);
          public               postgres    false    231            w           0    0    tiket_duplicated_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tiket_duplicated_id_seq', 64, true);
          public               postgres    false    233            �           2606    29285    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public                 postgres    false    219            �           2606    29844    city city_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.city
    ADD CONSTRAINT city_pkey PRIMARY KEY (city_id);
 8   ALTER TABLE ONLY public.city DROP CONSTRAINT city_pkey;
       public                 postgres    false    239            �           2606    29932    employee employee_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_pkey PRIMARY KEY ("NIP");
 @   ALTER TABLE ONLY public.employee DROP CONSTRAINT employee_pkey;
       public                 postgres    false    230            �           2606    29642 "   kantor_wilayah kantor_wilayah_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY public.kantor_wilayah
    ADD CONSTRAINT kantor_wilayah_pkey PRIMARY KEY (kanwil_id);
 L   ALTER TABLE ONLY public.kantor_wilayah DROP CONSTRAINT kantor_wilayah_pkey;
       public                 postgres    false    226            �           2606    29944    m_address m_address_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.m_address
    ADD CONSTRAINT m_address_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.m_address DROP CONSTRAINT m_address_pkey;
       public                 postgres    false    244            �           2606    29170     tiket_status m_ticketstatus_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tiket_status
    ADD CONSTRAINT m_ticketstatus_pkey PRIMARY KEY (status_id);
 J   ALTER TABLE ONLY public.tiket_status DROP CONSTRAINT m_ticketstatus_pkey;
       public                 postgres    false    217            �           2606    29176 "   tiket_urgency m_ticketurgensi_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.tiket_urgency
    ADD CONSTRAINT m_ticketurgensi_pkey PRIMARY KEY (urgency_id);
 L   ALTER TABLE ONLY public.tiket_urgency DROP CONSTRAINT m_ticketurgensi_pkey;
       public                 postgres    false    218            �           2606    29888    merchant merchant1_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.merchant
    ADD CONSTRAINT merchant1_pkey PRIMARY KEY ("MID");
 A   ALTER TABLE ONLY public.merchant DROP CONSTRAINT merchant1_pkey;
       public                 postgres    false    240            �           2606    29832 (   merchant_category merchant_category_pkey 
   CONSTRAINT     x   ALTER TABLE ONLY public.merchant_category
    ADD CONSTRAINT merchant_category_pkey PRIMARY KEY (merchant_category_id);
 R   ALTER TABLE ONLY public.merchant_category DROP CONSTRAINT merchant_category_pkey;
       public                 postgres    false    237            �           2606    29613 "   merchant_otp merchant_otp_new_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.merchant_otp
    ADD CONSTRAINT merchant_otp_new_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.merchant_otp DROP CONSTRAINT merchant_otp_new_pkey;
       public                 postgres    false    222            �           2606    29918    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public                 postgres    false    242            �           2606    29629    role role_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (role_id);
 8   ALTER TABLE ONLY public.role DROP CONSTRAINT role_pkey;
       public                 postgres    false    224            �           2606    29649     service_point service_point_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.service_point
    ADD CONSTRAINT service_point_pkey PRIMARY KEY (service_point_id);
 J   ALTER TABLE ONLY public.service_point DROP CONSTRAINT service_point_pkey;
       public                 postgres    false    228            �           2606    29929    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public                 postgres    false    243            �           2606    29827 -   tiket_status_detail ticket_status_detail_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.tiket_status_detail
    ADD CONSTRAINT ticket_status_detail_pkey PRIMARY KEY (id);
 W   ALTER TABLE ONLY public.tiket_status_detail DROP CONSTRAINT ticket_status_detail_pkey;
       public                 postgres    false    236            �           2606    29740 "   tiket_category tiket_category_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.tiket_category
    ADD CONSTRAINT tiket_category_pkey PRIMARY KEY (category_id);
 L   ALTER TABLE ONLY public.tiket_category DROP CONSTRAINT tiket_category_pkey;
       public                 postgres    false    232            �           2606    29768    tiket tiket_duplicated_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.tiket
    ADD CONSTRAINT tiket_duplicated_pkey PRIMARY KEY (id);
 E   ALTER TABLE ONLY public.tiket DROP CONSTRAINT tiket_duplicated_pkey;
       public                 postgres    false    234            �           2606    29568    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public                 postgres    false    220            �           2606    29566    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public                 postgres    false    220            �           2606    29664    employee employee_role_fkey    FK CONSTRAINT     {   ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_role_fkey FOREIGN KEY (role) REFERENCES public.role(role_id);
 E   ALTER TABLE ONLY public.employee DROP CONSTRAINT employee_role_fkey;
       public               postgres    false    230    4753    224            �           2606    29669 $   employee employee_service_point_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.employee
    ADD CONSTRAINT employee_service_point_fkey FOREIGN KEY (service_point) REFERENCES public.service_point(service_point_id);
 N   ALTER TABLE ONLY public.employee DROP CONSTRAINT employee_service_point_fkey;
       public               postgres    false    230    4757    228            �           2606    29630    users fk_role_id    FK CONSTRAINT     s   ALTER TABLE ONLY public.users
    ADD CONSTRAINT fk_role_id FOREIGN KEY (role_id) REFERENCES public.role(role_id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT fk_role_id;
       public               postgres    false    224    4753    220            �           2606    29889    merchant merchant1_city_fkey    FK CONSTRAINT     |   ALTER TABLE ONLY public.merchant
    ADD CONSTRAINT merchant1_city_fkey FOREIGN KEY (city) REFERENCES public.city(city_id);
 F   ALTER TABLE ONLY public.merchant DROP CONSTRAINT merchant1_city_fkey;
       public               postgres    false    240    4769    239            �           2606    29894 ,   merchant merchant1_merchant_category_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.merchant
    ADD CONSTRAINT merchant1_merchant_category_id_fkey FOREIGN KEY (merchant_category_id) REFERENCES public.merchant_category(merchant_category_id);
 V   ALTER TABLE ONLY public.merchant DROP CONSTRAINT merchant1_merchant_category_id_fkey;
       public               postgres    false    237    4767    240            �           2606    29899 %   merchant merchant1_service_point_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.merchant
    ADD CONSTRAINT merchant1_service_point_fkey FOREIGN KEY (service_point) REFERENCES public.service_point(service_point_id);
 O   ALTER TABLE ONLY public.merchant DROP CONSTRAINT merchant1_service_point_fkey;
       public               postgres    false    4757    240    228            �           2606    29650 '   service_point service_point_kanwil_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.service_point
    ADD CONSTRAINT service_point_kanwil_fkey FOREIGN KEY (kanwil) REFERENCES public.kantor_wilayah(kanwil_id);
 Q   ALTER TABLE ONLY public.service_point DROP CONSTRAINT service_point_kanwil_fkey;
       public               postgres    false    4755    226    228            D   (   x��/)�2�̴2231�0��4476633566����� ��      X   �  x�]�Mk�0��ү�c���:n��l����zQ�	nbgpb����3i
=�ы�J�4�Eߣd-*~�*�O:4h�<շ�hƂq!�%4f��b����D�k.}?�1�Ƞ�~!�B@3�S@!�%gg*��,jƁ��(���`M?�A�L���G�4w���i@��o
qA)���9�E�����rH��8'A��Ō�v��w��M\���v^�=�,�o��q
Y��߅������G�"k8��>r���y��̱�ŕ��y^b��Nc�#��\�S^�3's�����zGT%��.�Vp�n׮f5�h<��O�����}W�.���%�\�گ5�@mtu�����@-�أ\y3���?l>�W�_8�X���hLݹ�S���~ ����      O   �  x��Z[S�H}�����5�y�%� E%3�[�"�N��c��5����	���*��Hݭ���Qg�X��j�o��������2oL�/�>��g�ׁ��~v�$Q(�̧�����,�aҲ�F��@���\K�_$hz���h�EheF3ѾS������r}��@ir�N���P<�[���/�o<c$�X�Vκ	?�-:l��E��s��'7Pl-�#�O�����V+��R`�rڼ/ԥ�s���<��|9��7�����K�E^������'>Y��1��oh'�}r�$����x���eGH"ʁ�n0vvA��?�<&s�Q�ॄވ��oxq_��4{�E�b�q��_=�^�Y�a����k��+:Ih���M�/9��\�
LA�	R�P���LT�:��/A�ʣ/fx��No��Ȧ����N�*��8�b;N�l��P^�K/��ԣ{Y���a��hd��z�=.Ĥ�@_�;t��v��7��W�SH֏���n���0���l+E�4J	���<��cvn�\�wl5pV�N�4����JB��DǌK��p�K�@/��q�k1���+�;�e�XP&.�G����<����k:����@N����^6ЈN��dZu�%n*hġ�.}��\���6t�`�}B}��VΟE���~Qu�Ў��%T�7v���Eu.ji���ߖ�oC�S�ܤ!�s?�*X�7��_�OH����e�"`M��k�S%O?�h�f��e)W!�f�6/�)\�7B�(��]�w�02n�p���v�z�7���mG�$Y�y̽���]�aa�I�r�>3�o�D�@�.m��k�J���(�̰����n~�$��,Jq�{��(�����#x��6?Ja�����!3~�n�Y��;����d)�����1�Ǒ�{�X2�f����H�Z�]Sv�jM���7?�c��j�MB�Q2��˺�s��1��1�Ƚx��c��b�D���㌯`ke��p�A�c���o�����9�D�78�
�W�}����+�|�*�ЋL�*/��*��;�5�3k�(e֌=Q�Z��R>�7�"~=T�G���A���B"w,���n�^��4kpU0E|�]��H#�N���al�Z�)z�<��ݴAq,���?D�X�o�G)�c�6�$�2�J�8��a!v�5���8%.����S#��!����!�!�l��Nj����^�Tb�V@e�$ɡ(\0��&/A�@Q�r+���໡i�����:��m�	'Dy9=�I�!�m`��'���M���u���!F���4�K�M#��wcb��҉=ϥ����)�	�^�=��Ҋ���Äy�Ζ�m23�Sq�6��D�nJL#�m|�������TĿ3���bMwΰ%,��? ���Ǥc׋N��w$֐����2�F)���p ���T�)�b�w��)�y��PC�p���RsA��4HO��$��e�� y��{���C���	��Ü��{���Մ�J�ɢ�p )ؕ�f	��߰����5�4���Ԥ�D�I^x�TZ������=�2b��܈��	�~0���������!�-��!F��M�z���-�}a�� z��vYH����B�Dԩ��P�>�f��q�dŰ�Fێ�rE�إײ�	��k^]��/o�)�RVmך�Q�*����c�D�3��5�$�m�Ɩ�Ʃ����u��7ߊ��$ޏߐ0R�r�OA���L�T�B���#HD[�VДEo�N �hM[?��_���M�b.1z���S���r���ϓ^�� O� E��N�a
�#�nW��F�>˷�r�GV�!#����;��"����6�{�{���� ��
�5/�C<�%��a�1�����j}���FѴ�Ȃ�s:�;3=�B�����9a2wA|�>�N)1�sh���=JQ7�$d�o�[l�E턠ĜB�BIȱi��6�3�Yn)�4cS�4!ne��gsY<�{+��yd>(�(�
�@�Y��#
MxDuG~�Y!�0����Li�\�#��=Gn��z';��
Pt��Mt��uW�3$�9��T�>�o�
z���i�@���КV�O�wE"N8��~h��7��! ?��^d3Yt��&h����E�SQ�F�u�C(]��"�ޣQ�(f�׏hD�=z��s	f`��o�?ġ���ey�1���O�>�lxGt      K   A   x�3��J�N,*I�2��N�+��Q��2�1�<�LlO.S$�B"�\K�9��egzr��qqq �       ]   z   x�M��
�0Eg��ʣ)�.8hCš�˭�V�������s9~׿A΂�VQ����&���S����Ԫ��73#��u�����+S�[1�'�T��+��T��ȷݾuwq�� <<*T      Y   h   x�5�1
�0�Y>�O "�еt)�d��E�d��)�LoyBB�Ô�x�"� �g���p��V�h�PG3�7�j˫v��k�B3>�@~�T
�$%m�R� s�!G      V   K   x�3�t,*Q��/�2���/I��2�J-.I,-J�+Q�WpNLKR
�I\&@���̜�<.Sΐ��2��=... �
:      G   c  x��ZKr�8[?�"Ȕ�ӧ�2�?ǀ��ۢ��$��B�$
�����_�Tx�_���R���Ƌ��3b���3<�T�_x��y�I��d�'}��	�h������E����Χ��'���-���R����M��|L�|z�g�G�x�_|[OVF�gh�S�x��-bX����6�O{�l����)"�[�QظE��#��݈VP��5`���`C�W��dL��}󔣔&�:�3��;��B9Qh����	ψ��8��*��錈^�k�
�d_Þ�:��X��.���O+��u&�
��Aeֻ q���=`"�
����&|Ko���!A�pJz��{��V8�4jo7M����0��
���3z�:�9V�R��z���:"DuN)C�Dz�G�-@�ɐR�	��O�-�U-1��)e ��<A�k$�z��)el:W4�֝DZ8�T[�[�8�)*�b;{�2U��#��ݲ��I)���ց�u B�IR��#��ND�G�(�2u<I>}8#�����aب�癈Ꝉj��2�1��<�y�N$�HJ�2�'���U�D
�HNDy��q1��I)Ccܤ��D���.�y�H�/��7��;�MHkrOoEW���UjќgPku'":��%�O�S�hJD��@�?p��+/���Л��k��`��K���j��+�R��!߻�"=��J�:��9�Ф���M����n�sv˃���etb�g@�R�>qD����p�����LJx���!�\�.����� ��p����3V4�MF��(���b)e0���CDr'")�R�1Љ���<��s6���Aq]è��O���V���j��쑽/߈��
k׭sT���A�u�G,����V�g�9à�{^r�f�r��2���u/�>#��"�֊R��e�x"Bz_�ց!�a�,����z��p�}[� 辢�2PS
�����e��V�h)e ��H�Џ��ޣ�UZJ��a�"�m���G\Z�3���tU��u�a[N��Z~���JK)�6�������䷤2�{�:��n�D̀��R����"��G2��׈u`�唁��k2���a�=�7Fu�Q�ib4ڼ7����m�ߘ�H���2���϶��w&� ȉzJ�k=��w��-�-=�D��z�*����S��9��n�{!��"�V���2tЌ[2xٮ_���d�)�h�#(Z��o��ܜ����y�2���c	��R�j�y�ˀ���{�� @���'(��&�:*=7�d�m΀���&��[��s���g��
L~�zwYF�3L�pF�\��?X���{�d�}��T���0��2r��U(�9|z��AX�H)��"Y3���5`e�&�sp����׬;�5�)e����4��{tb��\Fn9���u���������ݯ��2�\o+rǃnb[���+�)��^�	����,�&^�m��R���n���
����?8��Rat��2 (�\jĦ{�RU�}_����5��c�[fRL6�Ϳ�Ww7�N��!��Tg�3(j�5������?X���Ra�{Xv#R�*	3b(�̔2 ��_4�}�d
�	S���R����w      [      x������ � �      I   6   x�3��M�KLO-�2�IM���LN�Q.-(�/*�2��M-J�H�+����� W�      M     x�=��j�0�ϳO�'(����Sm�
�l�1�-���o�U��6��j��
�.�餿�^F��2�h�Ѹ�y(*pe(z�/E����
/���=j�qd��=��;xv�H��j;φ�(M�����b���԰�P��K\(�P�ϲ�M���u41�����K��Iԝ�����9�=�<��4r�;�&^R���¹��MZ���M�.fh{#��g9Z'!��8�-�1ݴ�U�9�y�*|�a��]��3� �vmO      \   �  x�͒Ko�0���+�l�Q��<��.(	!���4���<l��B~�Z�f7���K������tii��F��y�[3M��D�THi9U@�*�����<��$�F�JJ��$
~yȚ�Ip� x�Y�U~zU~fmKs?O��n�@�	���ے��7��u.XyZ7�¼86,� �Q����X~��B҈���
U��b"u4)m-MI���uol}�H�`l,މ������a��zº�S+ۜdG<��+�\���f��� �X2UD�[o�=��K�!R#UmV��r����U��˗ue�ؘ]�\���iB�)s�|g��s�׵���J��N�{�3b}�J?>y�o�9��Ϛ�j� �hhʄy�����9��;��C�+�L��`�)!3�-��BװZ1L�";Y!�7�#� [^�X������Wۻ//#�A�Ae*Kc���N�ȏX�KI�p�v����E��0���"2��?OF���+��q@�t����@NR	�K1������~ӕ���^�5�ߒ!ƾs�wBj�o#>�ф9��־��TMH�閠O�m����R_��>׊8O�'�����2���I�#��`U�!*"kS!f_����bl�2~��1�4$����zc��!b(~%B�
�ߟ���/��Tq      S   �  x��XIr�H<S��X�J$/}��\�})��DS�\�ÿ�@q��3���RI����K����ML����G����PE�.�{l��TuQ�b����Q�eW�O.�L�w�K��~o�^�ʚ�����UF�Br�]�N�u�)�q���fg��7VY���*b-���x�|x�}�ONq��l�N��-rI]�J~"˲��[O����aj���Ksc��Τ ��_���x�G٪K���_��Y!)�U�u��{}W��>�b�T�,�����@�3��v;�N�U��⢒��ETV���/!����:Xp��+b����LH.��TW^#����y��Y��s��ޔ5
T5�l���m{o	�+�̵��@�Wo����&�SȄM����y0a�	�{�L,�c�N7�x�,�Dݽ��/�0�M�z}�؇\)?;5�S��e��n]�j��?9�vjQy�3��S�����@O�:s�]�%���{����n���#�GT�o�ӹ�{���]��5z�oc�EJ�{��7z�۶��C�n����������s�k��;��_����X���X�N�^C���u���?s./�M�g�x��3���>Rw�P��ܦ��W��#Pm�� �L�%w#����j�Hʓ�|��[�[���p�٠���p�)���Qx֒�2�#T��Z�g*�'(��"ބ�Qќ�T�w���h����8k�Jn������:A�~�֬]�iД���u�>� �;1k�$�"֋)1��SU@Zz�\e�:�W��irl�-j����D�B�SyZ�^ԇ��~�����mxT�����ee��Qȃ��� �" �z��l0	����z|�D̏�y%9�`�0%+v`0Y�J��	��0XL.��dD�?b���7�o� �t���A����tt���#�q����p�t��R
���[�]YF4L��h��2/�M�E�=�e�yh���a� 	�N_���D����a��m���_X����􅺕���^��Զ��o6��m��ah&�A��.�,X�Y��=
3���z̆l+uB��	��QU�t�s��}�jϥ��UnA �8*٬s�5��ѽ@ɢ��"��Qx�GO=Q��ݚВ�Sٔm�|���q������Bv����4�B0�C�P���q<M7$r@V����.��nŚGe��-�#��y1��cGF6�1V�:ު�)b(C/���*پ�0�qdۅGЄ��yeO���yd�W��@ej�N�ˋ��j.�4��@�)�۸(�L�y�Vqi�I�*1W��>�<������rkQ`�VĢ�y�I	<��(O<ǯ��������R+�j����@vz�6hا����i��ϛ���<��س�f�i��"y�j��C �.��i�jl]��T����;/�=y�/E]���}]Pu�֞u�'h���m�E����bڔ1p� ��Y�jδ��[l�z\,eK���e�)���'7�!w��_x�i���ЏȻ@F�`w5n*�Լ�M�Y2��d�f=���w�������Ͳ��([);E�Ѭ�d�F�֠G�6+ƈc��@�~xyd�Zk��;��֝'{�e�����Y��V~�lv��?!|+��s`�0�l�3�=����^��z�d��������z�����j�C�	�,�|�g�V�7"�̶�g��l2i�̭vy���3J�{Or�~=�~���v�#�	Z      Q   c   x�E�K
B1�q�*���8�X��Ƥ��xfgOR���eZ��@Zn��(KBqܚ�>���z$�61����������B�Ss��k���4�>�; ?n�      B   8   x�3��/H��2���S(�O/J-.�2�t��K�2��K-�2�t��/NM����� H��      U     x�}�;�,7E��*fc�?}*v�=83>;���K�gX�R�A}@R�%E5���������Y�(q�$9�D�-�!$�&���e���Ƌ�#��5�����`2Ɨ�I܃�ٰ$y*�w���IP���~pM�A�l��Id�sYl�`J��F{C�$6dC ��L�$5�lA3�Z��qT�$Ib�A|�%���nf�AA�g�(�W_=��� ��0��%)�'${]T	B�H0�W���%��IG�87$�jG�Nơ��8�+�|�!%Y��B�Th��?Cc%Gr!��t(�B��S��΂Hq�����9���BH�H��ioD�ʕ
��J���-�Z��[�GWn�TO�5U�~����˙H�Rc:���&y�� ��:t�#�+��� N:=�!C��Px�2K?��oB� D�b&_l0l�lx�hǘ8š>�`Crj9�ȝPI��oKM�����ż����Yx�3�J.^�6�	1�� ��"���j-Y	qv��A��	�Es�>�f��QSoA�l�O���S����m|�[��b�禛��A�C�w?&N�� ��< ��݊> ��u�dv�`fR.�|�c����{@	)��ǉ(? 
@�
@���$"yDy!}D 9"E��d������]�٥c�T��R�V0����ׯ����-��a�5���O�Wv2�/}V�K;Dȃ>�`F�k��4%nc���> �}z-�YY�r�P�{���ݽ�^��z��H}`�lP���r�2;'�}^�c����f�w��O�+�#�"���u$��*�� /c�B󮹄���|]!�?1�'���u��~$;�;W��ĸG}.��-�Dl��ވ�^ڈ�CM� W f3c!��G�����c�4+y�Q\'N�$4�B�_g�^�wq�K Z�CYcs%���ƛ�U�ka�����^7"�_O�ƭy"���S&���߯{v_xS�*Q:�Wsl�^� xM�+��fC�����a�?d���j����"H�e�ظ�5?8�ae<�2�Y�w+e���M��[lE0q h�������$��h"�A��\�Y4�(����������{��;��� n�šo�� �=��#����x�����Od�ޑ�iA㕶8�̾"/.�8���j����8�Y8�!����G
u��
�ơyE�d-��wt��5��
�]Y��|Xα��~�@\/E�8r�|O��n=],���2��G/���/��r�� �d� �z;���{O��R��~�      C   #   x�3���/�2���/�M��2���L������� b��      E   �   x�U�Ao�0 �3����V@nf�'ŀn:� ��BC���z�.�%/�]^�!������:�n����d�w2��HQ!��&eń���n7�M�ͣU溉��_��a3��k��3>�����z�,
���>O������!@����Ȳ�;9���i�2(�/j�|n�;�+HWk��"�%Kb��*Ro#������(�z.�-�*; ��=O	     