const { createApp } = Vue;

createApp({
    data() {
        return {
            newStudent: {
                name: '',
                status: '',
                species: '',
            }
        };
    },
    created() {
    },
    methods: {
        addStudent() {
            axios
                .post(
                    /* 1° argomento di post(): URL dove faccio la chiamata */
                    'http://localhost/43-lc-php-json/backend/students_store.php',
                    /* 2° argomento di post(): oggetto con dentro i dati da inviare */
                    {
                        student: this.newStudent
                    },
                    /* 3° argomento di post(): oggetto che mi consente di usare la chiave headers per aggiungere header nella richiesta */
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                .then(res => {
                    if (res.data.success) {
                        alert('Studente aggiunto con successo!');

                        this.newStudent.name = '';
                        this.newStudent.status = '';
                        this.newStudent.species = '';
                    }
                    else {
                        alert(res.data.message);
                    }
                });
        }
    }
}).mount('#app');