<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <p>Apresentar indicadores do sistema</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token"],
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        login(e) {
            let url = "http://localhost:8000/api/login";

            let config = {
                method: "post",
                body: new URLSearchParams({
                    email: this.email,
                    password: this.password,
                }),
            };

            fetch(url, config)
                .then((response) => response.json())
                .then((data) => {
                    if (data.token) {
                        document.cookie =
                            "token=" + data.token + ";SameSite=Lax";
                    }
                });

            e.target.submit();
        },
    },
};
</script>
