<template>
    <div>
        <div>
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Ögrenci Listesi</h1>
                </div>
            </section>
            <section>
                <div class="py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Ögrenci No</th>
                                    <th>İsim - Soyisim</th>
                                    <!--                                    <th class="exam">1- Yazılı</th>-->
                                    <!--                                    <th class="exam">2- Yazılı</th>-->
                                    <!--                                    <th class="exam">3- Yazılı</th>-->
                                    <!--                                    <th class="exam">1- Performans</th>-->
                                    <!--                                    <th class="exam">2- Performans</th>-->
                                    <!--                                    <th class="exam">Proje</th>-->
                                    <th>Ortalama</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(data,index) in resultData">
                                    <th>{{ data.id }}</th>
                                    <td>{{ data.name }}</td>
                                    <td class="text-center text-white bg-info" :ref="'average' + index">
                                        {{ calculateAverage(data.notes, index) }}
                                    </td>
                                    <th>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                @click="modalInsertData(data.id,data.name,data.notes)"
                                                data-target="#exampleModal">
                                            Notlar
                                        </button>
                                    </th>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="modal bd-example-modal-lg fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ this.modalTitle }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="exam">1- Yazılı</th>
                                <th class="exam">2- Yazılı</th>
                                <th class="exam">3- Yazılı</th>
                                <th class="exam">1- Performans</th>
                                <th class="exam">2- Performans</th>
                                <th class="exam">Proje</th>
                                <th>Ortalama</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td class="exam text-center" @click="examEdit('first_exam')">
                                    <p :ref="'first_exam'">{{ exams.first_exam }}</p>
                                    <input type="number" :ref="'first_exam_input'" v-model="exams.first_exam"
                                           class="form-control w-100">
                                </td>
                                <td class="exam text-center" @click="examEdit('second_exam')">
                                    <p :ref="'second_exam'">{{ exams.second_exam }}</p>
                                    <input type="number" :ref="'second_exam_input'" v-model="exams.second_exam"
                                           class="form-control w-100">
                                </td>
                                <td class="exam text-center" @click="examEdit('third_exam')">
                                    <p :ref="'third_exam'">{{ exams.third_exam }}</p>
                                    <input type="number" :ref="'third_exam_input'" v-model="exams.third_exam"
                                           class="form-control w-100">
                                </td>
                                <td class="exam text-center" @click="examEdit('first_performance')">
                                    <p :ref="'first_performance'">{{ exams.first_performance }}</p>
                                    <input type="number" :ref="'first_performance_input'"
                                           v-model="exams.first_performance"
                                           class="form-control w-100">
                                </td>
                                <td class="exam text-center" @click="examEdit('second_performance')">
                                    <p :ref="'second_performance'">{{ exams.second_performance }}</p>
                                    <input type="number" :ref="'second_performance_input'"
                                           v-model="exams.second_performance"
                                           class="form-control w-100">
                                </td>
                                <td class="exam text-center" @click="examEdit('project')">
                                    <p :ref="'project'">{{ exams.project }}</p>
                                    <input type="number" :ref="'project_input'" v-model="exams.project"
                                           class="form-control w-100">
                                </td>
                                <td class="text-center text-white bg-info">{{ average }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-success" :ref="'save_btn'" :disabled="true"
                                @click="saveExams(exams.student_id)">Kaydet
                        </button>
                        <button class="btn btn-sm btn-warning" data-dismiss="modal"
                                @click="hideRowAllInput()">Vazgeç
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            resultData: null,
            average: 0,
            exams: {
                student_id: null,
                first_exam: null,
                second_exam: null,
                third_exam: null,
                first_performance: null,
                second_performance: null,
                project: null,
            },
            modalTitle: null,
        }
    },
    methods: {
        calculateAverage(studentExams) {

            var average = 0;
            if (studentExams === null) {
                return average;
            }
            average = (studentExams.first_exam + studentExams.second_exam + studentExams.third_exam + studentExams.first_performance + studentExams.second_performance + studentExams.project) / 6;
            return average.toFixed(2);
        },
        examEdit(row) {
            $(this.$refs[row]).hide();
            $(this.$refs[row + '_input']).show();
            this.actionButtonStatus(false);
        },
        hideRowAllInput() {
            this.actionButtonStatus(true);

            $(this.$refs['first_exam_input']).hide();
            $(this.$refs['second_exam_input']).hide();
            $(this.$refs['third_exam_input']).hide();
            $(this.$refs['first_performance_input']).hide();
            $(this.$refs['second_performance_input']).hide();
            $(this.$refs['project_input']).hide();

            $(this.$refs['first_exam']).show();
            $(this.$refs['second_exam']).show();
            $(this.$refs['third_exam']).show();
            $(this.$refs['first_performance']).show();
            $(this.$refs['second_performance']).show();
            $(this.$refs['project']).show();
        },
        async saveExams(id) {
            console.log(id)
            await axios.put('students/' + id, this.exams).then(res => {
                console.log(res.data)
                if (res.data && res.data.success) {
                    $('#exampleModal').modal('hide');
                    location.reload();
                }
            })
                .catch(e => {
                    console.log(e);
                })
        },
        actionButtonStatus(status) {
            $(this.$refs['save_btn']).prop('disabled', status);
            $(this.$refs['cancel_btn']).prop('disabled', status);
        },
        getStudentList() {
            axios.get('/students')
                .then(res => {
                    this.resultData = res.data.data;
                })
                .catch(e => {
                    console.log(e)
                })
        },
        modalInsertData(id, title, exams) {
            this.modalTitle = title;
            this.exams.student_id = id;
            if (exams) {
                this.exams.first_exam = exams.first_exam ?? 0;
                this.exams.second_exam = exams.second_exam ?? 0;
                this.exams.third_exam = exams.third_exam ?? 0;
                this.exams.first_performance = exams.first_performance ?? 0;
                this.exams.second_performance = exams.second_performance ?? 0;
                this.exams.project = exams.project ?? 0;
            } else {
                this.exams.first_exam = 0
                this.exams.second_exam = 0
                this.exams.third_exam = 0
                this.exams.first_performance = 0
                this.exams.second_performance = 0
                this.exams.project = 0
            }
        }
    },
    async mounted() {
        try {
            await this.getStudentList();
        } catch (err) {
            console.log(err)
        }
    },
    watch: {
        exams: {
            handler(oldVal, val) {

                this.average = ((parseInt(val.first_exam) + parseInt(val.second_exam) + parseInt(val.third_exam) + parseInt(val.first_performance) + parseInt(val.second_performance) + parseInt(val.project)) / 6).toFixed(2)
            },
            deep: true
        },
    }
}
</script>

<style scoped>

th {
    white-space: nowrap;
}

td {
    white-space: nowrap;
}

.exam {
    width: 15% !important;
}

.exam:hover {
    cursor: pointer;
    white-space: nowrap;
}

input {
    display: none;
    width: 100% !important;
}

</style>
