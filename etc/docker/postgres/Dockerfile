FROM postgres:15.5

COPY init-database.sh /docker-entrypoint-initdb.d/

RUN chmod -R +x /docker-entrypoint-initdb.d/*
