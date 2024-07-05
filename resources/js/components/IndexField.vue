<template>
  <div class="relative w-fit" >
    <!-- Text -->
    <span 
      :class="!field.disableLink && 'link-default'"
      class="w-fit"
      @mouseenter="show = true"
      @mouseleave="show = false"
      @click="handleClick"  
    >
      <span v-html="truncatedText"></span>
    </span>
    <!-- Tooltip -->
    <a v-if="show && canHover" v-html="tooltipText" class="tooltip absolute top-0 left-3/4 bg-gray-600 text-white px-3 py-1 rounded-lg z-50"></a>
  </div>
</template>

<script>
export default {
  props: ['resourceName', 'field'],
  data() {
    return {
      show: false,
    }
  },
  computed: {
    limit() {
      return this.field.limit ?? '50'
    },
    fieldValue() {
      return this.field.displayedAs || this.field.value
    },
    tooltipText() {
      const chunksize = 4
      const texts = this.fieldValue.split(' ')
      let chunks = []
      for (let i = 0; i < texts.length; i += chunksize) {
        chunks.push(texts.slice(i, i + chunksize).join(' '));
      }

      return chunks.join('<br>');
    },
    truncatedText() {
      if (!this.canHover) {
        return this.fieldValue;
      }

      if (this.fieldValue.length > 30) {
        const text = this.fieldValue.split(' ');

        if (text.length > 3) {
          var firstline = text.slice(0, 3).join(' ')
          var secondline = text.slice(3).join(' ')

          if (secondline.length > 30) {
            secondline = secondline.substring(0, 30) + '...'
          }

          return `${firstline} <br> ${secondline}`;
        }
      }

      return this.fieldValue.substring(0, this.limit) + '...';
    },
    tooltip() {
      
    },
    canHover() {
      return this.fieldValue.length >= this.limit;
    }
  },
  methods: {
    handleClick(e) {
      e.preventDefault();
      this.field.href ? window.location.href = this.field.href : null;
    }
  }
}
</script>