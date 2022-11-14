PGDMP         (            
    z         
   reporthing    14.5    14.5                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16395 
   reporthing    DATABASE     g   CREATE DATABASE reporthing WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Mexico.1252';
    DROP DATABASE reporthing;
                postgres    false            �            1255    16396    cambiarestatus()    FUNCTION     �   CREATE FUNCTION public.cambiarestatus() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
begin 
UPDATE public.reportes
SET estatus= 0
WHERE fecha = CURRENT_DATE-32;
RETURN new;
END
$$;
 '   DROP FUNCTION public.cambiarestatus();
       public          postgres    false            �            1259    16397 
   reportados    TABLE     a   CREATE TABLE public.reportados (
    id_reporte integer NOT NULL,
    usuario bigint NOT NULL
);
    DROP TABLE public.reportados;
       public         heap    postgres    false            �            1259    16400    reportes    TABLE     �  CREATE TABLE public.reportes (
    id_reporte bigint NOT NULL,
    titulo character varying(100) NOT NULL,
    tipo integer NOT NULL,
    latitud character varying(50) NOT NULL,
    longitud character varying(50) NOT NULL,
    descripcion character varying(200),
    estatus integer NOT NULL,
    fecha date,
    hora character varying(2) DEFAULT NULL::character varying,
    zona character varying(15) DEFAULT NULL::character varying,
    minuto character varying(2) DEFAULT NULL::character varying
);
    DROP TABLE public.reportes;
       public         heap    postgres    false            �            1259    16406    reportes_id_reporte_seq    SEQUENCE     �   CREATE SEQUENCE public.reportes_id_reporte_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.reportes_id_reporte_seq;
       public          postgres    false    210                       0    0    reportes_id_reporte_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.reportes_id_reporte_seq OWNED BY public.reportes.id_reporte;
          public          postgres    false    211            �            1259    16407    reportes_realizados    TABLE     m   CREATE TABLE public.reportes_realizados (
    id_usuario bigint NOT NULL,
    id_reporte integer NOT NULL
);
 '   DROP TABLE public.reportes_realizados;
       public         heap    postgres    false            �            1259    16410    tipos    TABLE     �   CREATE TABLE public.tipos (
    id_tipos bigint NOT NULL,
    nombre character varying(32) NOT NULL,
    descripcion character varying(100) NOT NULL
);
    DROP TABLE public.tipos;
       public         heap    postgres    false            �            1259    16413    tipos_id_tipos_seq    SEQUENCE     {   CREATE SEQUENCE public.tipos_id_tipos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tipos_id_tipos_seq;
       public          postgres    false    213                       0    0    tipos_id_tipos_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tipos_id_tipos_seq OWNED BY public.tipos.id_tipos;
          public          postgres    false    214            �            1259    16414    usuarios    TABLE       CREATE TABLE public.usuarios (
    id_usuarios bigint NOT NULL,
    username character varying(32) NOT NULL,
    correo character varying(32) NOT NULL,
    contrasena character varying(50) NOT NULL,
    administrador integer NOT NULL,
    avatar character varying(100) NOT NULL
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            �            1259    16417    usuarios_id_usuarios_seq    SEQUENCE     �   CREATE SEQUENCE public.usuarios_id_usuarios_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.usuarios_id_usuarios_seq;
       public          postgres    false    215                       0    0    usuarios_id_usuarios_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.usuarios_id_usuarios_seq OWNED BY public.usuarios.id_usuarios;
          public          postgres    false    216            r           2604    16418    reportes id_reporte    DEFAULT     z   ALTER TABLE ONLY public.reportes ALTER COLUMN id_reporte SET DEFAULT nextval('public.reportes_id_reporte_seq'::regclass);
 B   ALTER TABLE public.reportes ALTER COLUMN id_reporte DROP DEFAULT;
       public          postgres    false    211    210            s           2604    16419    tipos id_tipos    DEFAULT     p   ALTER TABLE ONLY public.tipos ALTER COLUMN id_tipos SET DEFAULT nextval('public.tipos_id_tipos_seq'::regclass);
 =   ALTER TABLE public.tipos ALTER COLUMN id_tipos DROP DEFAULT;
       public          postgres    false    214    213            t           2604    16420    usuarios id_usuarios    DEFAULT     |   ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuarios SET DEFAULT nextval('public.usuarios_id_usuarios_seq'::regclass);
 C   ALTER TABLE public.usuarios ALTER COLUMN id_usuarios DROP DEFAULT;
       public          postgres    false    216    215                      0    16397 
   reportados 
   TABLE DATA           9   COPY public.reportados (id_reporte, usuario) FROM stdin;
    public          postgres    false    209   �"                 0    16400    reportes 
   TABLE DATA           �   COPY public.reportes (id_reporte, titulo, tipo, latitud, longitud, descripcion, estatus, fecha, hora, zona, minuto) FROM stdin;
    public          postgres    false    210   ;#       
          0    16407    reportes_realizados 
   TABLE DATA           E   COPY public.reportes_realizados (id_usuario, id_reporte) FROM stdin;
    public          postgres    false    212   [A                 0    16410    tipos 
   TABLE DATA           >   COPY public.tipos (id_tipos, nombre, descripcion) FROM stdin;
    public          postgres    false    213   D                 0    16414    usuarios 
   TABLE DATA           d   COPY public.usuarios (id_usuarios, username, correo, contrasena, administrador, avatar) FROM stdin;
    public          postgres    false    215   E                  0    0    reportes_id_reporte_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.reportes_id_reporte_seq', 1, false);
          public          postgres    false    211                       0    0    tipos_id_tipos_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.tipos_id_tipos_seq', 1, false);
          public          postgres    false    214                       0    0    usuarios_id_usuarios_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.usuarios_id_usuarios_seq', 1, false);
          public          postgres    false    216            v           2606    16422    reportes reportes_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_pkey PRIMARY KEY (id_reporte);
 @   ALTER TABLE ONLY public.reportes DROP CONSTRAINT reportes_pkey;
       public            postgres    false    210            x           2606    16424    tipos tipos_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.tipos
    ADD CONSTRAINT tipos_pkey PRIMARY KEY (id_tipos);
 :   ALTER TABLE ONLY public.tipos DROP CONSTRAINT tipos_pkey;
       public            postgres    false    213            z           2606    16426    usuarios usuarios_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuarios);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public            postgres    false    215            {           2620    16427    reportes triggerestatus    TRIGGER     u   CREATE TRIGGER triggerestatus AFTER INSERT ON public.reportes FOR EACH ROW EXECUTE FUNCTION public.cambiarestatus();
 0   DROP TRIGGER triggerestatus ON public.reportes;
       public          postgres    false    217    210               f   x�����0�3.���I�^��aw���(N�h�a11�⟕��t���ւtA�M"��O�"�_��mUF�o֦�C�uSg�r�g����Gl���=y'9            x��\M��Fr=�~_{��dbƨ��v��ƞY6|ɪb�p�*��bK=7�����>�����"��d��`�0v�;��.2#3"^���u�z:��ؔ]S��+]�s��?�ͱ�\ٌ?N����Ue*[	��Ҙ��g�jY+������h;�g�ݮ�7�sS��<��vח�~(�=^~j7�M��z!��q]������u�\��F��}|�ûz�k��{;�݇�ǩ)Ih�Ԋ�,K*n���0�[)�wm�u̓;�����-d��Ѿ���q*���d��N��]o$+n]Gg�$���{x��1HR��Xf�U��J��*c�����Y�[p��q758���,���%��p��J�s�p'���v#�߻�������Ʋ�-�I��
��kƳ;z-w�q�x!��9�TR1m����1B3fצ������Io���#��ql&le\	mf��F��M�v[<sv���n���������������J�x[=����GٱKz�~�����^9�����C[n�n\��-��N��F��ӽ��@Xz�y�6��B-�idR�R8�pN�8T/p~T����}�O����������>�^)��'�q-�L�Lm���DT*
f`�����`z#��?$�0�ѕQ^?I)ki���x��0��f���4��x�`8��~r!��+��
��q2~�����$/h����|�9o*/�7�6��_�_��zA?"W�pf��5� ���R5�U	,�����~���= �l�r���> M�����[?7E0<�v䑤����DÍ��h9�f�k)��J���s݃W*��azĿ��E�K�Q�%��hi��Q��MY&`P8w@՟�����a����W�<mC�8C � '�k��f|p;�MO�u��2VI�Q"��=���e1�F��UJ���W�A@Y|�H�������(�)��g��Բ��JKpc5<
 8��/^��b3�o���R3�А�������Ym�Ѩ�axV��x��u�HV����E8���Ԓu˰1l���J���J@&{S֐��-�	\^58Ж�����Ϥ~����N�/NCȍ��(Q"�������c�J3U1�=p���& a�Mq
����1#A
S��u���r�?�����"����~=c����S�k\�S0+�l��0̊	�XQݚ�g��z�`	�����	��b�p$UT&&z 8�Җ�i;�]���#E���W���~��~ps�XY�N�Zj�yhK�������:���ֶ��p�� ~���Ix	��Z��1�a�Grb:$bh+�V���m��~�����8Ɏ����ĢV(��	\c���=\%��&�%t�v�I ���:�Cnv��ݔ�n�j�L�&�U��,�El�����d����p�!x]�LU]|s��	��c�8F��_��4��� w��:�T�k/�tj^�e����9�p�(Sƣ�S��#ҁ� �2����M�8�֪����1�l�7'�;{̚��e�4@@ DOQf����2�o<��w���1zr�3�>Ĺu�S3�����oG_�,����(fEC��������F������~�?Hp
;1_<�'/���oێ@b&��ӯX�'F}��9�/o�a7`
;:������uF_D5\�'���o;7��i��R��w���K�0FB�s@�Rp�K�$��1<v���z,��G
�#�����f>������ x��"	񫕌bI�����/��]��U�
���	��|�+0ؔY<T�m����f{���ڦU�u�6 �w�9-\yG�1�1qcH� �V��r�2�o���������p�����C�o!�����]���۾^���Z��aՋ<%bb9� ]��X!4�S O��Ur�\����.N��3����+L��a�E�d2�3�3�5ҕJ>���h�<�9R���o��zj>�wn�,�,S��ؒ�������2�GD���k�q��` fd��S�}�0$�DA�N��I�;�X�j?�մ�L�m�L�;r��|`�m�B���U���s+8�@����L�9��Z�%�V8A<�sBٔ�� ��Ƒ$c �����5����z��F�o����y�v��f���l�R��D3�'֊#�A3O�1l{*�=����)X�$�M�.9WN� �;B�H�����-�������\��(�� 3#�1��J�4g�+~.fdQ1or���2t ��G�@iq�J��l��NF�l3Fq_�q��Xd�!�E|x�?��A,�-��b]�<����Q�
䄒\7	G**jX	��3	��d�A⛀�y
�Ff`!$1����d"�ӽ�F6�-�߀D�.$Y�O�>��؟[,��9�<#�-w-������TR�"YVK����2GԎ�Z8�U'���\PKn�x)��B!?�����l�Rʅ����P�Jމ���H~V���NiX-����VL�چ�L�J�����"ż���s�����>yV�Ƶ?.��F���05۔[B��jlE�~C>���H]��NQq Ҽ�駟��P��N�*C�E?�)?	 ㄕ�7\�bcTIt�_$T	*�EB�x�L�>nk	s#��Ͽ"��pr�>�6vQ8�ɌR�bp��B	J� �*�;�.^e>&�&ɠc����P��mש��'�ʛ����W�	�����P���3�2 z��a��*�T�=N�y9�^tf�O�
�+�ԥ��6`�����[.�h���")8�N[TVXK|��X�������Jd����.����e*�a[�}���L�
A��a2�o�Qփ�`��|�\���J�@z��Ldg-4 rU��(���:�'܇v%�^g%<��X�I�9�l�A�G[Z D��Ȝ*��C꽡���ⱌ�X����>p^×�����7ϝA�0Y���}��{8`��k��Lï	��f����g	ARv:3
��K��ˣ]�6}��f���L8��C���לB�%=BK����6����'�07#�7w�`�nx�*����*�H �Ԟ�������j�@��C�8F!�=����j�J�ME��[�.����캧_��`�Ib����M*ݤE$t�8����M�/��J���N�;E�3�kX5�2���S��9��R��= �-?4ÑR�O��i���N��z ��B���$ԟ�d����9L7�T!>��J���+ls뒇�nh�������	���B����\�[��A���!]�R^9���- �b�%HV��/�|	���i\t�Tn��D��LH+rqKm�U���~�b�/t̫�)� a�� �R�G~c,�RY\-��|�|��Z�E�c@I��p.�ӲbT����w��>�$f�i��#�A:�UF��l��L�^��vM�R��;�5I(�Xf�DJ�C[�fwn�br7䆔D����|�אɌYr�\�@V�(h�fc�7)S~>�A,�z��(�T���,�� ;���9ø|��%�EHh���H��CR0'm0��I�:�h�P��j݁D� WU���H� Ewt�����d_B/��-�;$~ �:g~��9ӕ4����W����������3̀���)�#��0j�IUמ�g˛�3���������a#7|�ǩO��+Yq_��ۅGF �:�S�R#2*H�DE �瀱�����+��Ч6?���.Q��Y����0����� ~�1�R��5��Bȕ{y�:����O���&$�Ȯ�UG��Œm��I�87��8l ħ��I�8U
�_�00=0�i��z1٪*�䦁�?�!d�
|�g�B��*�J�?�T����h.�H(��<^{�[|�b*Ė�۶�0Wg�S�gղ�E0T�'I� ?�8d%�Km3�ܶOWKTy	�p]�s�%HH蜬/U�%Ûs�

`�rE��T���6c��7���`�u�u��z��j)��.��kCu   u�8�uR�2Q�չQi��͉8�	si�z�:mQ��wh>(���aK�B㚩K7y���h�e��k���T
w��ų �6}y�����Q|!�ϜV�7#`�� �c�f"M�2��$����_R&�b�$���%��Z���w���������5$�L�y���G�~��"4���M�S&��t�'!4熥âV��w�#�}߁�{^ph�T��?��B�+)/���wӞ
K��i�d�A����@� ��B̸4������Q�`��i�&��_ק�s4�6 y�wr�)W}(z*1qA�Re�cV�k���c:�'߈��Tv\(e���d\I�
�
�T��<�C�*�MH��S�b,cHS�e��8�z�����h�:kCe��v���O����B��P���C��(�b΅���S �<����?����~7A ��I!4舷��nl;Ě ?�㏗��O��ܹ�{���ė�(q?Qb�������Q��ol�l��LK�T���Z����Y�Hy+Jo@����B���qO��R��{�C��^0�&�������+���]C��HuC2��/]o�njV�N�p�S�I�)ޚI[���<ǃ����V�įT�w~+Vq���>"�w��=BD�dnh^g��7��x^��+ߺ!�&ayH���V>q�#�65�)�� �V �e�W��v�ˇ��{v�8_IRD���;�Z�?�iߐ���طC�O�j�X{�̦H��Znj���m�k�KS�Ҡ?�P�,��in[���WG��@�.J��-|��k�7�M쟼AF�����f?���c��Bhi#v���` ��ُ��S(|q��I�-��Pε�NEC���Dv��� ��[`(5�M������r�J��S�Z-B
T���B�&�M�Y	㨅� �?B�zf�&d��̑ʲk{]N��դMϹ8 Pi�~*B�'\ӆ����c�k���/>A ��)X�r��ԕo�"b�i�-�h+F�����R,���G\y�aH0���Ѳ�k^��'؂�!��b�����C���Ll�n,E��2�+�2<E#�ҏ��qB!z\ʾ px2���ܶT��/��=f����;�k'�φ���f94��2�FʮW/B3D�%�O�k��au�?�hxZ���`?ᤏ|#������>����z�ww��HAk\ǿ0����W��ㇸ��|L���½�Ʋ�5���uVrX� yl�$�,��aW��	�f"ac�܄H}�����&H(@x�;���hևXB���y��;���m�	�\�f6�\m,/�i�l��\��G�B�? ��p�QT���4���]���
Ŧg�[�=+R������[�����p�j�4�W�1��ѩ�c��S���}�"C( xR7�'i���re�4�N�1(]�~I�̀Ӡ��<`h�*��\0[p����/���з�A>R�ڿ�1���u���@{��gu�r
7yH�����x���c�6Կ�9D�2�Mnp��B�9��W�����|;��0���lw+4�4��hB�� ��.f�Jo�~��o�p�i����/#|�p�Q�2B����Cj'�r�#�g�ɟڣ�����𻹥����_��W�.:rc���� � �XEW ccaÆ�*ȿaL
�C@���#@�W�:?�v�Mc���?���Tne\��P��g	������%�[L���!湦5���z&l@�Cd������NC�F3�H*�IW,ո�s7����U��� k���<f�C��-�Peg�ͦ�ydx� v��5�4���R$����+ 3G�z�?��&��?��-H�H9.�^fF3���� {h(�$+�����|-b_�qî�(U��E%�/�p ��%B�� ��;�B!���n�%1V��7����&5jQA���A"4���
Ԫ�Jd�B��a����/O=���j�ю����:�N~..��?;x5Cw�M[8\��k�1�6��M4��G�#+E�]�
E���`�*9��b!P�R�0\����ط�M�o��58]����v92.�3NuDe���@[ʱt-��y?�El�5Ӑ���ˤ�r���� �vNwk�#�$OtY���͑BD�q线&o;z+����;���Hȹ������Cu׎�P2��Tp��Ŕ������1�^�<��(���m(��ʍ=|�F���
�r��[��~�4um A�"��,�3q+��%i�
c�CӥkP ���|U�'\��{�c�o�$X?^j����@E��TDI��{f�j%��������D�t@L�978I��l��љ�H.,I���Z�CBҮ��C��c�}.��t��Po�9]�����c����,�$k;�!���)�AT�r|�x��EsBq�t��������i�݃k}Jm���B��y~O%��{�}{I4�E�oab���>�2�izdV��r���W	'MV��j�@P2����n]8�ժU�|�8�U�l�_[��@��'��g� �0��cWk����U3�/au���]:�TڰT��k��|vR����)	����Jt[JSЧ�/��+im�A�����A��ƸC��A�w��S|8xn��L0�W~%_��%�<�G��"�t����PT��B��ۉ�-��Q�>���X8>�q��M\��1*�V��Ou�pr!��q͔g�>Ez續�)x°��)Q��ͱ��V�d��a.���M��8�f|��݂y�n� �V�V�ڝ��!ޤ�-�\����~���;ns���׋��|)dI�j���}�D��$l�����l�gmt��U�Ҳ�40�z~)���dU�/�P��}���a�L�6ͥ���;!!�����K�����=\U��VO��S�O�F�L���.���)e%��2_N#�{���l3#��5-�2��4�\ ��'>���+�B:#�S�p�UĊ�_�04���2��J}����	ej�O�$ّ�q%4-%Bt;Z��"��W)_���Y���d�lii�a�ȱȞr~KëԮ�*�%N��e1�N=���V�W2�ܵ/h��{x0�Z��t`�]���W& �pv/nO#��z��g�I`X6���֪�q���C�mu��jΜ�Y��A�/Es$�ח�W(����"߲�m�����@��&5�ib<q~���a�.��K�?��O�W#�NOC����Ɇ���n��x���C/��â�������?��t����	u����,YZ�]`3WO�-+ga��u.V�3��/dF����}���g��_��=���n���;N4ɡrR��TU(��;��nĩ�JKk�03�#��<�D��Z)���>��A�?�O�!��z�����x4�wS�F"A��(,�8#Lc�_\�8�r~OK�D'&��a����<��2�̼�C�6 e�~	�h�<"���$��!F�ɹ��u+�K�C�8�>Pq?_=�K5��s��W4�W	��r���/'x�ft%��pa�s��hA��&�L�����Əl������{��l��߼      
     x�mUۍ1�����%��ʞ	.@�5x�%������#$�ЪB��4#��X5�?� ��D|�^��B�|h^�&H��E/��i��Dא|,F�I>�$/���(���$y� d�Ke�1_.S�N�2z�Lk7�~���2c��K�9ŋ2(_TRIz��������t>d
��$e�!�$����� ���!|������?��i��>���XdH��c���L���.#3M����n�$ (o�F%�`o��%G^��D;8b�5\N�O0+��h�y��L��J��FL)�ݝ�#��j��
����E�������@uE���Jm.�a�f�6Ck�;(�3���z�큌p�?�>ݵ0c!�mxDy���`� �&�H��n���aw%�bPl86J%�"��
lG���Cs8��`{xQ�	��Y���?�ۻy;pa&��bP����=lu�!�VR���1Z� �"�xS�{V��e������]h����FjGG:��oYu�^�4ày95�Fz.��v�5|虆+F�]$�l]��S)Ls�����h���.�K&N$�*P�M�lLH�H��Յ>o�K�<rP���c���	����	��,�c�h�3v[�8���"�Ѐ�]ka_�]�.u��˱�`ւ,�<��Yo��.�ļ��ڵ?rM�Zm�y����E��>t�nhب}C�
2p�D;h��0���C_�ð]��
�!;n�<���1������0d��0���5�gt�m�ӵ$w�˜e'�.����<���@t         �   x�M�I
AE��)<A ����J��X�B;5lr��Mz%����ԨtOw�b�:2��Y�V�41k,�6�|�JŮ�������%*+�.f��#��\ҳ
�`u��a�K��}���kz��R�����  ?ގA�         n  x��R�n�0<�ߑ�A꭛/�-����)#��v���_%m��i@
g$�j�z��*JN2/�y��}9�j�ж)T;�Mo�vZ���O/�3]�GmlK�:�qu��0�q�=G�2g�,`<g��08ר��:��&��N��8��|���:vV���"�G.<���˃*Ջ�9���)�9��`�����䝢�?4�
�â�� �e�՚�N�ӿ��+1�Z$@rP5���$؄+=��r�n0����1�Zƶ�w#�[�m?FCP��:�7|�*�Xր��O(zM��K�O��!~��)�:����(YC�M<6_���l�Ę�M�*�N�_���dS&�(gq^������i�5��w]�=��     