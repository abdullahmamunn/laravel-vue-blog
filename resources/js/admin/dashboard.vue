<template>
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>Total User</h3>
          <p>{{ totalusers }}</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer"
          >More info <i class="fas fa-arrow-circle-right"></i
        ></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>Total Categories<sup style="font-size: 20px"></sup></h3>

          <p>{{ totalCategories }}</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer"
          >More info <i class="fas fa-arrow-circle-right"></i
        ></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>Total Posts</h3>
          <p>{{ totalPosts }}</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer"
          >More info <i class="fas fa-arrow-circle-right"></i
        ></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>Today's Posts</h3>
          <p>{{ TodaysPosts }}</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer"
          >More info <i class="fas fa-arrow-circle-right"></i
        ></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
</template>

<script>
export default {
  name: "dashboard",
  data(){
      return {
          totalusers: 0,
          totalCategories: 0,
          totalPosts: 0,
          TodaysPosts: 0,
      }
  }
};
</script>

<style scoped>
</style>
