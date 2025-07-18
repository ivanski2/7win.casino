<!-- live match table --><div class="top p-1 d-flex">
                <button @click="liveUpComing('live')" type="button" :class="{light: (showType == 'upcoming')}"  class="btn-custom me-1">
                    <i class="las la-podcast"></i>
                    <?php echo app('translator')->get('Live'); ?>
                </button>
                <button @click="liveUpComing('upcoming')" type="button" :class="{light: (showType == 'live')}"  class="btn-custom ">
                    <i class="las la-meteor"></i>
                    <?php echo app('translator')->get('Upcoming'); ?>
                </button>
            </div>
<div v-if="showType == 'live'"  v-for="(item, index) in allSports_filter" class="table-parent table-responsive d-sm-block d-none">

    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">
                <span v-html="item.game_category.icon"></span>
            </th>
            <th class="col-5">
               <span>
                   {{item.game_tournament.name}} <span v-if="item.name">- {{item.name}} </span>
               </span>
            </th>

            <th v-if="index <= 2" class="col-2" v-for="(question, index) in item.questions">
                <div class="d-flex justify-content-evenly">
                    <span><?php echo app('translator')->get('1'); ?></span>
                    <span>{{question.name}}</span>
                    <span><?php echo app('translator')->get('2'); ?></span>
                </div>
            </th>

            <template v-if="3 > (item.questions).length ">
                <th class="col-2" v-for="index in (3 - (item.questions).length )"
                    :key="index">
                    <div class="d-flex justify-content-evenly">
                        <span>1</span>
                        <span v-if="index == 1"><?php echo app('translator')->get('X'); ?></span>
                        <span v-if="index == 2"><?php echo app('translator')->get('2X'); ?></span>
                        <span v-if="index == 3"><?php echo app('translator')->get('3X'); ?></span>
                        <span>2</span>
                    </div>
                </th>
            </template>
            <th class="col-1 text-center"><?php echo app('translator')->get('More'); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
           <td class="text-center">{{ item.start_datetime }}
            </td>
            
            <td>
                <p>
                    <span style="color:white">
                        {{ item.team1 }}
                        <b style="color:red">vs.</b>
                        {{ item.team2 }}
                    </span>
                </p>
                <p>
                    <span class="float-end">
                        <a href="" class="me-2 d-none">
                            <i class="fal fa-chart-bar"></i>
                        </a>
                    </span>
                </p>
            </td>

            <td v-if="index <= 2" v-for="(question, index) in item.questions">
                <div class="d-flex justify-content-evenly w-100">
                    <button type="button" :disabled="option.is_unlock_question == 1 || option.is_unlock_match == 1 "
                            :class="{ disabled: (option.is_unlock_question == 1 || option.is_unlock_match == 1) }"
                            v-for="(option, index) in question.options"
                            :title="option.option_name" @click="addToSlip(option)">
                        <i v-if="option.is_unlock_question == 1 || option.is_unlock_match == 1"
                           class="fas fa-lock-alt"></i> {{ option.ratio}}
                    </button>
                </div>

                <div v-if="(question.options).length == 0" class="d-flex justify-content-evenly w-100">
                    <button type="button" class="disabled downgrade">-</button>
                    <button type="button" class="disabled downgrade">-</button>
                </div>

            </td>

            <template v-if="3 > (item.questions).length ">
                <td v-for="index in (3 - (item.questions).length )" :key="index">
                    <div class="d-flex justify-content-evenly w-100">
                        <button type="button" class="disabled downgrade">-</button>
                        <button type="button" class="disabled downgrade">-</button>
                    </div>
                </td>
            </template>
            <td>
                <button type="button" v-if="0 == (item.questions).length" disabled class="disabled">-</button>
                <button @click="goMatch(item)" type="button" v-else>+{{ (item.questions).length }}</button>
            </td>
        </tr>
    </table>
</div>


<!-- Upcoming match table -->
<div  v-if="showType == 'upcoming'"  v-for="(item, index) in upcoming_filter" class="table-parent table-responsive d-sm-block d-none">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">
                <span v-html="item.game_category.icon"></span>
            </th>
            <th class="col-5">
               <span>
                   {{item.game_tournament.name}} <span v-if="item.name">- {{item.name}} </span>
               </span>
            </th>

            <th v-if="index <= 2" class="col-2" v-for="(question, index) in item.questions">
                <div class="d-flex justify-content-evenly">
                    <span><?php echo app('translator')->get('1'); ?></span>
                    <span>{{question.name}}</span>
                    <span><?php echo app('translator')->get('2'); ?></span>
                </div>
            </th>

            <template v-if="3 > (item.questions).length ">
                <th class="col-2" v-for="index in (3 - (item.questions).length )"
                    :key="index">
                    <div class="d-flex justify-content-evenly">
                        <span><?php echo app('translator')->get('1'); ?></span>
                        <span v-if="index == 1"><?php echo app('translator')->get('X'); ?></span>
                        <span v-if="index == 2"><?php echo app('translator')->get('2X'); ?></span>
                        <span v-if="index == 3"><?php echo app('translator')->get('3X'); ?></span>
                        <span>2</span>
                    </div>
                </th>
            </template>
            <th class="col-1 text-center"><?php echo app('translator')->get('More'); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center">{{ item.start_datetime }}
            </td>
            <td>
                <p>
                    <span style="color:white">
                        {{ item.team1 }}
                        <b style="color:red">vs.</b>
                        {{ item.team2 }}
                    </span>
                </p>
                <p>
                    <span class="float-end">
                        <a href="" class="me-2 d-none">
                            <i class="fal fa-chart-bar"></i>
                        </a>
                    </span>
                </p>
            </td>

            <td v-if="index <= 2" v-for="(question, index) in item.questions">
                <div class="d-flex justify-content-evenly w-100">
                    <button type="button" :disabled="option.is_unlock_question == 1 || option.is_unlock_match == 1 "
                            :class="{ disabled: (option.is_unlock_question == 1 || option.is_unlock_match == 1) }"
                            v-for="(option, index) in question.options"
                            :title="option.option_name" @click="addToSlip(option)">
                        <i v-if="option.is_unlock_question == 1 || option.is_unlock_match == 1"
                           class="fas fa-lock-alt"></i> {{ option.ratio}}
                    </button>
                </div>

                <div v-if="(question.options).length == 0" class="d-flex justify-content-evenly w-100">
                    <button type="button" class="disabled downgrade">-</button>
                    <button type="button" class="disabled downgrade">-</button>
                </div>

            </td>

            <template v-if="3 > (item.questions).length ">
                <td v-for="index in (3 - (item.questions).length )" :key="index">
                    <div class="d-flex justify-content-evenly w-100">
                        <button type="button" class="disabled downgrade">-</button>
                        <button type="button" class="disabled downgrade">-</button>
                    </div>
                </td>
            </template>
            <td>
                <button type="button" v-if="0 == (item.questions).length" disabled class="disabled">-</button>
                <button @click="goMatch(item)" type="button" v-else>+{{ (item.questions).length }}</button>
            </td>
        </tr>
    </table>
</div>

<div class="live-matches d-sm-none" v-if="showType == 'live'">
    <h5><?php echo app('translator')->get('Live Matches'); ?></h5>
    <div class="live-matches-slider owl-carousel">
        <div class="box" v-for="(item, index) in allSports_filter">
            <h5 class="mb-3">{{ item.game_tournament.name }}</h5>
            <div
                class="row d-flex justify-content-around align-items-center">
                <div class="col-3 team">
                    <img
                        class="img-fluid"
                        :src="item.team1_img"
                        alt="..."
                    />
                    <p>{{ item.team1}}</p>
                </div>
                <div class="col-6">
                    <span>{{item.name}} </span>
                    <h5 v-if="0 < item.questions.length ">{{ slicedArray(item.questions).name}}</h5>
                    <button class="btn-custom w-75 my-2" @click="goMatch(item)"><?php echo app('translator')->get('See More'); ?></button>
                </div>
                <div class="col-3 team">
                    <img
                        class="img-fluid"
                        :src="item.team2_img"
                        alt="..."
                    />
                    <p>{{ item.team2}}</p>
                </div>

                <div class="col-12 align-self-end">

                    <div v-if="0 < item.questions.length" class="d-flex justify-content-between">
                        <button class="btn-light" type="button"
                                :class="{ disabled: (option.is_unlock_question == 1 || option.is_unlock_match == 1) }"
                                :disabled="option.is_unlock_question == 1 || option.is_unlock_match == 1 "
                                :title="option.option_name"
                                @click="addToSlip(option)"
                                v-for="(option, index) in (slicedArray(item.questions).options)">

                            <i v-if="option.is_unlock_question == 1 || option.is_unlock_match == 1"
                               class="fas fa-lock-alt"></i>
                            {{ option.ratio }}
                        </button>

                    </div>

                    <div v-else class="d-flex justify-content-between">
                        <button type="button" disabled class="btn-light disabled downgrade-mobile">-</button>
                        <button type="button" disabled class="btn-light disabled downgrade-mobile">-</button>
                        <button type="button" disabled class="btn-light disabled downgrade-mobile">-</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="live-matches d-sm-none" v-if="showType == 'upcoming'">
    <h5><?php echo app('translator')->get('Upcoming Matches'); ?></h5>
    <div class="live-matches-slider owl-carousel">
        <div class="box" v-for="(item, index) in upcoming_filter">
            <h5 class="mb-3">{{ item.game_tournament.name }}</h5>
            <div
                class="row d-flex justify-content-around align-items-center">
                <div class="col-3 team">
                    <img
                        class="img-fluid"
                        :src="item.team1_img"
                        alt="..."
                    />
                    <p>{{ item.team1}}</p>
                </div>
                <div class="col-6">
                    <span>{{item.name}} </span>
                    <h5 v-if="0 < item.questions.length ">{{ slicedArray(item.questions).name}}</h5>
                    <button class="btn-custom w-75 my-2" @click="goMatch(item)"><?php echo app('translator')->get('See More'); ?></button>
                </div>
                <div class="col-3 team">
                    <img
                        class="img-fluid"
                        :src="item.team2_img"
                        alt="..."
                    />
                    <p>{{ item.team2}}</p>
                </div>

                <div class="col-12 align-self-end">

                    <div v-if="0 < item.questions.length" class="d-flex justify-content-between">
                        <button class="btn-light" type="button"
                                :class="{ disabled: (option.is_unlock_question == 1 || option.is_unlock_match == 1) }"
                                :disabled="option.is_unlock_question == 1 || option.is_unlock_match == 1 "
                                :title="option.option_name"
                                @click="addToSlip(option)"
                                v-for="(option, index) in (slicedArray(item.questions).options)">

                            <i v-if="option.is_unlock_question == 1 || option.is_unlock_match == 1"
                               class="fas fa-lock-alt"></i>
                            {{ option.ratio }}
                        </button>

                    </div>

                    <div v-else class="d-flex justify-content-between">
                        <button type="button" disabled class="btn-light disabled downgrade-mobile">-</button>
                        <button type="button" disabled class="btn-light disabled downgrade-mobile">-</button>
                        <button type="button" disabled class="btn-light disabled downgrade-mobile">-</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/centur69/majesticsport.centurybreakcap.com/resources/views/themes/betting/partials/home/content.blade.php ENDPATH**/ ?>