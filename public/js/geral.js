function capitalizeWords(str) {
    return str.toLowerCase().replace(/\b\w/g, function(l) {
      return l.toUpperCase();
    });
  }

